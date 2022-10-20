import webpack from 'webpack-stream';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import { src, dest, watch, series, parallel } from 'gulp';
import yargs from 'yargs';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import named from 'vinyl-named';
import browserSync from "browser-sync";
import imagemin from "gulp-imagemin";
import del from 'del';

const PRODUCTION = yargs.argv.prod;
const sass = require('gulp-sass')(require('sass'));

export const styles = () => {
    return src(['src/css/style.scss', 'src/css/admin.scss'])
        .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(PRODUCTION, postcss([ autoprefixer ])))
        .pipe(gulpif(PRODUCTION, cleanCss({compatibility:'ie8'})))
        .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
        .pipe(dest('dist/css'))
        .pipe(server.stream());
}

export const images = () => {
    return src('src/images/**/*.{jpg,jpeg,png,svg,gif}')
        .pipe(gulpif(PRODUCTION, imagemin()))
        .pipe(dest('dist/images'));
}

export const scripts = () => {
    return src(['src/js/app.js'])
        .pipe(named())
        .pipe(webpack({
            module: {
                rules: [
                    {
                        test: /\.js$/,
                        use: {
                            loader: 'babel-loader',
                            options: {
                                presets: []
                            }
                        }
                    }
                ]
            },
            mode: PRODUCTION ? 'production' : 'development',
            devtool: !PRODUCTION ? 'inline-source-map' : false,
            output: {
                filename: '[name].js'
            },
            externals: {
                jquery: 'jQuery'
            },
        }))
        .pipe(dest('dist/js'));
}

export const clean = () => del(['dist']);

export const copy = () => {
    return src(['src/**/*','!src/{images,js,scss}','!src/{images,js,scss}/**/*'])
        .pipe(dest('dist'));
}

const server = browserSync.create();
export const serve = done => {
    server.init({
        proxy: "http://wordpress-pure.local" // put your local website link here
    });
    done();
};
export const reload = done => {
    server.reload();
    done();
};

export const watchForChanges = () => {
    watch('src/css/**/*.scss', styles);
    watch('src/images/**/*.{jpg,jpeg,png,svg,gif}', series(images, reload));
    watch(['src/**/*','!src/{images,js,scss}','!src/{images,js,scss}/**/*'], series(copy, reload));
    watch('src/js/**/*.js', series(scripts, reload));
    watch("**/*.php", reload);
}
export const dev = series(clean, parallel(styles, images, scripts), serve, watchForChanges);
export const build = series(clean, parallel(styles, images, scripts));
export default dev;

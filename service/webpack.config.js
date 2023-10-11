const Encore = require('@symfony/webpack-encore');
const webpack = require('webpack')

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/swagger/')
    .setPublicPath('/build/swagger')
    .addEntry('swagger', './assets/swagger/main.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    .copyFiles([
        {from: './assets/swagger/images', to: '../swagger/images/[path][name].[ext]'},
    ])
    .enableSassLoader(function(options) {}, {
        resolveUrlLoader: false
    });
const swaggerConfig = Encore.getWebpackConfig();
swaggerConfig.name = 'swaggerConfig';
Encore.reset();

Encore
    .setOutputPath('public/build/app/')
    .setPublicPath('/build/app')
    .addEntry('app', './assets/app/bootstrap.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableVueLoader(() => {}, { runtimeCompilerBuild: false })
    .addPlugin(new webpack.DefinePlugin({
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: true,
    }))
    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    .copyFiles([
        {from: './assets/app/images', to: '../app/images/[path][name].[ext]'},
    ])
    .enableSassLoader(function(options) {}, {
        resolveUrlLoader: false
    });
const appConfig = Encore.getWebpackConfig();
appConfig.name = 'appConfig';
Encore.reset();

module.exports = [swaggerConfig, appConfig];

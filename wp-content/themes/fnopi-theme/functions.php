<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });


    
function fnopi_related_block_render_callback($block)
{ 
    echo view('blocks/fnopi_related', ['block' => $block]);
}   
function fnopi_terms_block_render_callback($block)
{ 
    echo view('blocks/fnopi_terms', ['block' => $block]);
}   

function fnopi_story_video_block_render_callback($block)
{
    echo view('blocks/fnopi_story_video', ['block' => $block]);
}


function fnopi_stories_archive_block_render_callback($block)
{
    echo view('blocks/fnopi_stories_archive', ['block' => $block]);
}

function  fnopi_timeline_archive_block_render_callback($block)
{
    echo view('blocks/fnopi_timeline_archive', ['block' => $block]);
}
    
function  fnopi_home_timeline_block_render_callback($block)
{
    echo view('blocks/fnopi_home_timeline', ['block' => $block]);
}

function  fnopi_video_block_render_callback($block)
{
    echo view('blocks/fnopi_video', ['block' => $block]);
}

function  fnopi_grid_block_render_callback($block)
{
    echo view('blocks/fnopi_grid', ['block' => $block]);
}

function  fnopi_stories_block_render_callback($block)
{
    echo view('blocks/fnopi_stories', ['block' => $block]);
}

function  fnopi_video_reference_block_render_callback($block)
{
    echo view('blocks/fnopi_video_reference', ['block' => $block]);
}

function  fnopi_related_news_block_render_callback($block)
{
    echo view('blocks/fnopi_related_news', ['block' => $block]);
}

function  fnopi_press_archive_block_render_callback($block)
{
    echo view('blocks/fnopi_press_archive', ['block' => $block]);
}
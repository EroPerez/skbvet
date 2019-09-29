<?php

function view_url($uri) {
    $CI = & get_instance();
    return $CI->config->base_url($CI->config->item('views') . '' . $uri);
}

function view_img($uri, $tag = false) {
    if ($tag) {
        return '<img class="img-responsive" src="' . view_url('assets/images/' . $uri) . '" alt="' . $tag . '">';
    } else {
        return view_url('assets/img/' . $uri);
    }
}

function view_img_load($uri, $tag = false) {
    if ($tag) {
        return '<img class="img-responsive" src="' . view_url('assets/uploads/files/' . $uri) . '" alt="' . $tag . '">';
    } else {
        return view_url('assets/uploads/files/' . $uri);
    }
}

function view_js($uri, $tag = false) {
    if ($tag) {
        return '<script type="text/javascript" src="' . view_url('assets/' . $uri) . '"></script>';
    } else {
        return view_url('assets/' . $uri);
    }
}

function view_js_plugin($uri, $tag = false) {
    if ($tag) {
        return '<script type="text/javascript" src="' . view_url('assets/plugins/' . $uri) . '"></script>';
    } else {
        return view_url('assets/plugins/' . $uri);
    }
}

function view_css($uri, $tag = false) {
    if ($tag) {
        $media = false;
        if (is_string($tag)) {
            $media = 'media="' . $tag . '"';
        }
        return '<link href="' . view_url('assets/' . $uri) . '" type="text/css" rel="stylesheet" ' . $media . '/>';
    }

    return view_url('assets/' . $uri);
}

function view_fonts($uri, $tag = false) {
    if ($tag) {
        $media = false;
        if (is_string($tag)) {
            $media = 'media="' . $tag . '"';
        }
        return '<link href="' . view_url('assets/' . $uri) . '" type="text/css" rel="stylesheet" ' . $media . '/>';
    }

    return view_url('assets/' . $uri);
}

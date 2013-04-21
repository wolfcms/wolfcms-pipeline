<?php

class mentionFilter {
    
    public function __construct() {
        ;
    }
    
    public function apply($in, $context = array()) {
        $baseUri = 'user/';
        $infoUri = 'about/mention';
        
        if (array_key_exists($context, 'base_uri')) {
            $baseUri = $context['base_uri'];
        }
        
        if (array_key_exists($context, 'info_uri')) {
            $baseUri = $context['info_uri'];
        }
        
        //$result = preg_replace('/\@(mention)[\s]+/i', '<a href="'.BASE_URI.$infoUri.'">@\1</a> ', $in);
        //$result = preg_replace('/\@(mentioned)[^\s]+/i', '<a href="'.BASE_URI.$infoUri.'">\1</a>', $result);
        $result = preg_replace('/\@([^\s]+)/i', '<a href="'.BASE_URI.$baseUri.'\1">@\1</a>', $in);
        
        return $result;
    }
}
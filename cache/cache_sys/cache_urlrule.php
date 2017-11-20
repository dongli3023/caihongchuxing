<?php
$_urlrule=array (
  0 => 
  array (
    'id' => '1',
    'class' => 'list',
    'ishtml' => '0',
    'urldemo' => 'index.php?m=content&c=index&f=lists&catid=1&l=1&page=1',
    'url' => 'index.php?m=content&c=index&f=lists&catid=[catid]&l=[languageid]&page=[page]',
    'is_fixed' => '1',
  ),
  1 => 
  array (
    'id' => '2',
    'class' => 'show',
    'ishtml' => '0',
    'urldemo' => 'index.php?m=content&c=index&f=show&catid=1&l=1&contentid=1',
    'url' => 'index.php?m=content&c=index&f=show&catid=[catid]&l=[languageid]&id=[id]',
    'is_fixed' => '1',
  ),
  2 => 
  array (
    'id' => '3',
    'class' => 'list',
    'ishtml' => '1',
    'urldemo' => 'it/news/1.html',
    'url' => '[languagedir][categorydir]/[catdir]/[page].html',
    'is_fixed' => '1',
  ),
  3 => 
  array (
    'id' => '4',
    'class' => 'show',
    'ishtml' => '1',
    'urldemo' => 'cn/2012/1212/1.html',
    'url' => '[languagedir][year]/[month][day]/[id].html',
    'is_fixed' => '1',
  ),
  4 => 
  array (
    'id' => '5',
    'class' => 'list',
    'ishtml' => '0',
    'urldemo' => 'list/1/1/1.html',
    'url' => 'list/[languageid]/[catid]/[page].html',
    'is_fixed' => '1',
  ),
  5 => 
  array (
    'id' => '6',
    'class' => 'show',
    'ishtml' => '0',
    'urldemo' => 'show_1_1_1.html',
    'url' => 'show_[languageid]_[catid]_[id].html',
    'is_fixed' => '1',
  ),
);
?>
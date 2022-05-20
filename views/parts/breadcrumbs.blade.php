<?php
/**
 * @var $breadcrumbs array
 */
?>

<ol class="breadcrumb">
    @foreach($breadcrumbs as $breadcrumb)
        @if($loop->last)
            <li class="active">{{ $breadcrumb['title'] }}</li>
        @elseif($loop->first)
            <li><a href="{{ $breadcrumb['href'] }}"><i class="fa fa-dashboard"></i>{{ $breadcrumb['title'] }}</a></li>
        @else
            <li><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['title'] }}</a></li>
        @endif
    @endforeach
</ol>

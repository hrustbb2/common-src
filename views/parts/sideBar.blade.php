<?php
/**
* @var Src\Sidebar\Interfaces\IMenu $sidebar
*/
?>

<section class="sidebar js-main-sidebar">
    <ul class="sidebar-menu js-sidebar-menu">
        @foreach ($sidebar->getMenuItems() as $menuItem)
            @if($menuItem->getSubItems())
                <li class="active js-sidebar-menu-item-container">
                    <a href="#" class="js-sidebar-menu-item-button">
                        <i class="fa fa-dashboard"></i>
                        <span class="sidebar-item-name js-item-name">{{ $menuItem->getTitle() }}</span>
                        <span class="sidebar-angle-button-container js-sub-items-toggle-button">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu js-sub-items">
                        @foreach($menuItem->getSubItems() as $subItem)
                            <li>
                                <a href="{{ $subItem->getUrl() }}">
                                    {{ $subItem->getTitle() }}
                                    @if($subItem->getBage())
                                        <span class="float-right badge badge-danger">{{ $subItem->getBage() }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="active js-sidebar-menu-item-container">
                    <a href="{{ $menuItem->getUrl() }}" class="js-sidebar-menu-item-button">
                        <i class="fa fa-dashboard"></i>
                        <span class="sidebar-item-name js-item-name">{{ $menuItem->getTitle() }}</span>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</section>
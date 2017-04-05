<ol class="dd-list">
    @foreach ($menu_nodes as $key => $row)
    <li class="dd-item dd3-item @if ($row->related_id > 0) post-item @endif" data-type="{{ $row->type }}" data-relatedid="{{ $row->related_id }}" data-title="{{ $row->getRelated()->name }}" data-class="{{ $row->css_class }}" data-id="{{ $row->id }}" data-customurl="{{ $row->url }}" data-iconfont="{{ $row->icon_font }}">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content">
            <span class="text pull-left" data-update="title">{{ $row->getRelated()->name }}</span>
            <span class="text pull-right">{{ $row->type }}</span>
            <a href="#" title="" class="show-item-details"><i class="fa fa-angle-down"></i></a>
            <div class="clearfix"></div>
        </div>
        <div class="item-details">
            <label class="pad-bot-5">
                <span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>
                <input type="text" name="title" value="{{ $row->getRelated()->name }}" data-old="{{ $row->getRelated()->name }}" >
            </label>
            @if (!$row->related_id)
            <label class="pad-bot-5 dis-inline-block">
                <span class="text pad-top-5" data-update="customurl">Url</span>
                <input type="text" name="customurl" value="{{ $row->url }}" data-old="{{ $row->url }}">
            </label>
            @endif
            <label class="pad-bot-5 dis-inline-block">
                <span class="text pad-top-5" data-update="iconfont">Icon - font</span>
                <input type="text" name="iconfont" value="{{ $row->icon_font }}" data-old="{{ $row->icon_font }}">
            </label>
            <label class="pad-bot-10">
                <span class="text pad-top-5 dis-inline-block">CSS class</span>
                <input type="text" name="class" value="{{ $row->css_class }}" data-old="{{ $row->css_class }}">
            </label>
            <div class="text-right">
                <a href="#" class="btn red btn-remove btn-sm">Remove</a>
                <a href="#" class="btn blue btn-cancel btn-sm">Cancel</a>
            </div>
        </div>
        <div class="clearfix"></div>
        @if ($row->hasChild())
            {!! Menu::generateMenu($menu->slug, $row->id) !!}
        @endif
    </li>
    @endforeach
</ol>

@extends('backends.backend')
@section('header')
    <title>AdminLTE 2 | User Profile</title>

    <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            {{ trans('backend.role') }}
        </h1>
    </section>
@endsection
@section('content')
    <section class="content">
        <!-- End Header Button -->
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-list" aria-hidden="true"></i> {{ trans('messages.list', ['name' => trans('backend.role')]) }}</h3>
                    </div>
                    {{-- /.box-header --}}
                    @include('flash::message')
                    <!-- /end .box-body -->
                    <div class="box-body">
                        <div id="coupon" class="col-md-12">
                            <div class="row">
                                <div class="col-left col-md-2">
                                    <div class="group-discount">
                                        <div class="brand-name"># LAZADA</div>
                                        <div class="discount-percent"> 20%</div>
                                        <div class="discount-price hidden-md hidden-lg"> 50.000.000.000 VND</div>
                                    </div>
                                </div>
                                <div class="col-right col-md-10">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h3 class="coupon-title">Đây là title Coupon</h3>
                                            <p class="coupon-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="cs-btn cs-btn-coupon pull-right" onclick="if(x==0)
                                                {x++;window.open('https://goo.gl/69Q3TK');}">
                                                <a style="color:black;text-decoration:none" data-toggle="modal" data-target="#Lazada1"><div class="ec-code">LOREAL20T5</div>
                                                <div class="ec-text"><i class="glyphicon glyphicon-paperclip"></i> COPY MÃ</div></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="list-coupon-code col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="group-discount">
                                        <div class="coupon-code-discount"> -10% </div>
                                        <div class="coupon-code-label">COUPON</div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="main-content-coupon">
                                                <h3 class="coupon-code-title">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                </h3>
                                                <div class="coupon-type">
                                                    <span class="brand-name">#LAZADA</span>
                                                    <span class="expired">Hết hạn</span>
                                                </div>
                                                <div class="coupon-description">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                </div>
                                                <div class="coupon-time">
                                                    <span class="start-date"><i class="fa fa-clock-o" aria-hidden="true"></i> Ngày bắt đầu: 19/05/2017</span>
                                                    <span class="end-date"><i class="fa fa-clock-o" aria-hidden="true"></i> Ngày kết thúc: 22/05/2017</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="coupon-detail">
                                                <a class="coupon-code" href="" tooltip="Nhấn để copy và mở trang khuyến mãi">
                                                    #123456ABC
                                                </a>
                                                <div class="code-partial-hidden">
                                                    <span class="meta-field coupon ">
                                                        <span class="value">
                                                            BTSBAGS <span class="units"></span>
                                                        </span>
                                                    </span>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="coupon-footer">
                                    <ul class="list-social">
                                        <li class="list-social-item">
                                            Chia sẻ:
                                        </li>
                                        <li class="list-social-item">
                                            <span><i class="fa fa-facebook-official" aria-hidden="true"></i></span>
                                        </li>
                                        <li class="list-social-item">
                                            <span><i class="fa fa-twitter" aria-hidden="true"></i></span>
                                        </li>
                                        <li class="list-social-item">
                                            <span><i class="fa fa-google-plus" aria-hidden="true"></i></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-content">
                                <div class="content-text">
                                    <div data-element="">
                                        <div class="code-content" data-section="popup">
                                            <div data-group="title content and get-code form" class="content-header">
                                                <div data-element="">
                                                    <div class="field ">
                                                        <h2 class="entry-title"><a href="http://azexo.com/kuponhub/product/up-to-70-off-store-promo-codes-free-shipping/" rel="bookmark">Extra 10% Off Select Luggage + Up To $220 Back In Points For Members</a></h2></div>
                                                </div>
                                                <div data-element="">
                                                    <div class="field ">
                                                        <div class="entry-content">Not applicable to ICANN fees, taxes, transfers,or gift cards. Cannot be used in conjunction with any other offer, sale, discount or promotion. After the initial purchase term.</div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div>
                                                        <span class="click">CLICK BELOW TO GET YOUR COUPON CODE</span>
                                                        <div class="wrapper-code">
                                                            <div class="coupon-wrapper copied">
                                                                <a href="#" target="_blank" data-code="BTSBAGS" class="coupon copied" data-copied="Code copied to the clipboard">Code copied to the clipboard</a>
                                                                <div class="code">BTSBAGS</div>
                                                            </div>
                                                            <span></span>
                                                            <span class="meta-field coupon ">  <span class="value">BTSBAGS <span class="units"></span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="work az-row">
                                                        <div class="az-column work-text">
                                                            Did this coupon work?
                                                        </div>
                                                        <div class="az-column work-field up">
                                                            <span class="voting-wrapper "><a href="http://azexo.com/kuponhub/wp-admin/admin-ajax.php?action=process_vote&amp;nonce=d96869979d&amp;post_id=178&amp;vote=up&amp;disabled=true&amp;is_comment=0" class="up voting-button voting-button-178" data-nonce="d96869979d" data-post-id="178" data-vote="up" data-iscomment="0" title="Up"><span>↑</span></a><span class="voting-votes">-1</span><span class="voting-loader"></span><a href="http://azexo.com/kuponhub/wp-admin/admin-ajax.php?action=process_vote&amp;nonce=d96869979d&amp;post_id=178&amp;vote=down&amp;disabled=true&amp;is_comment=0" class="down voting-button voting-button-178" data-nonce="d96869979d" data-post-id="178" data-vote="down" data-iscomment="0" title="Down"><span>↓</span></a></span>
                                                            <span class="yes vote-link">Yes</span>
                                                        </div>
                                                        <div class="az-column work-field down">
                                                            <span class="voting-wrapper "><a href="http://azexo.com/kuponhub/wp-admin/admin-ajax.php?action=process_vote&amp;nonce=d96869979d&amp;post_id=178&amp;vote=up&amp;disabled=true&amp;is_comment=0" class="up voting-button voting-button-178" data-nonce="d96869979d" data-post-id="178" data-vote="up" data-iscomment="0" title="Up"><span>↑</span></a><span class="voting-votes">-1</span><span class="voting-loader"></span><a href="http://azexo.com/kuponhub/wp-admin/admin-ajax.php?action=process_vote&amp;nonce=d96869979d&amp;post_id=178&amp;vote=down&amp;disabled=true&amp;is_comment=0" class="down voting-button voting-button-178" data-nonce="d96869979d" data-post-id="178" data-vote="down" data-iscomment="0" title="Down"><span>↓</span></a></span>
                                                            <span class="no vote-link">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <!-- /end .box-body -->
                    <!-- .box-body -->
                    <div class="box-body table-responsive no-padding">
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">

                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
                <!-- Action -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection
@section('script')
@endsection
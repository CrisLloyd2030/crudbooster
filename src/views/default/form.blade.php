@extends('crudbooster::admin_template')
@section('content')

    <div style="width: 1000px; margin:auto;">

        @if(CRUDBooster::getCurrentMethod() != 'getProfile' && $button_cancel)
            @if(g('return_url'))
                <p><a title='Return' href='{{g("return_url")}}'><i class='fa fa-chevron-circle-left '></i>
                        &nbsp; {{cbLang("form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>
            @else
                <p><a title='Main Module' href='{{CRUDBooster::mainpath()}}'><i class='fa fa-chevron-circle-left '></i>
                        &nbsp; {{cbLang("form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>
            @endif
        @endif

        <div class="panel panel-default" style='border-radius: 15px;'>
            <div class="panel-heading" style='border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 15px; border-top-right-radius: 15px;'>
                <strong><i class='{{CRUDBooster::getCurrentModule()->icon}}'></i> {!! $page_title !!}</strong>
            </div>

            <div class="panel-body" style="padding:20px 0px 0px 0px">
                <?php
                $action = (@$row) ? CRUDBooster::mainpath("edit-save/$row->id") : CRUDBooster::mainpath("add-save");
                $return_url = ($return_url) ?: g('return_url');
                ?>
                <form method='post' id="form" enctype="multipart/form-data" action='{{$action}}'>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type='hidden' name='return_url' value='{{ @$return_url }}'/>
                    <input type='hidden' name='ref_mainpath' value='{{ CRUDBooster::mainpath() }}'/>
                    <input type='hidden' name='ref_parameter' value='{{urldecode(http_build_query(@$_GET))}}'/>
                    @if($hide_form)
                        <input type="hidden" name="hide_form" value='{!! serialize($hide_form) !!}'>
                    @endif
                    <div class="box-body" id="parent-form-area">
                            @if($command == 'detail')
                                @include("crudbooster::default.form_detail")
                            @else
                                <div class="form-horizontal text-center">
                                @include("crudbooster::default.form_body")
                                </div>
                            @endif
                    </div><!-- /.box-body -->

                    <div class="box-footer" style="background: #F5F5F5; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">

                        <div class="form-group">
                            <!-- <label class="control-label col-sm-2"></label> -->
                            <div class="col-sm-12" style="text-align:center;">
                                @if($button_cancel && CRUDBooster::getCurrentMethod() != 'getDetail')
                                    @if(g('return_url'))
                                        <a href='{{g("return_url")}}' style="border-radius: 7px;" class='btn btn-default'><i
                                                    class='fa fa-chevron-circle-left'></i> {{cbLang("button_back")}}</a>
                                    @else
                                        <a href='{{CRUDBooster::mainpath("?".http_build_query(@$_GET)) }}' style="border-radius: 7px;" class='btn btn-default'><i
                                                    class='fa fa-chevron-circle-left'></i> {{cbLang("button_back")}}</a>
                                    @endif
                                @endif
                                @if(CRUDBooster::isCreate() || CRUDBooster::isUpdate())

                                    @if(CRUDBooster::isCreate() && $button_addmore==TRUE && $command == 'add')
                                        <input type="submit" name="submit" value='{{cbLang("button_save_more")}}' style="border-radius: 7px; margin-left: 5px" class='btn btn-success'>
                                    @endif

                                    @if($button_save && $command != 'detail')
                                        <input type="submit" name="submit" value='{{cbLang("button_save")}}' style="border-radius: 7px; margin-left: 5px" class='btn btn-success'>
                                    @endif

                                @endif
                            </div>
                        </div>


                    </div><!-- /.box-footer-->

                </form>

            </div>
        </div>
    </div><!--END AUTO MARGIN-->

@endsection


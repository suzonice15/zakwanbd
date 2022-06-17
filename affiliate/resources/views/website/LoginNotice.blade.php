@extends('website.master')
@section('mainContent')

    <section>
        <div class="container">
            <div class="row" style="margin-top: 100px">
                <div class="col-md-12">
                    <div class="panel panel-success" style="border-color: #ddd !important;">
                        <div class="panel panel-success" style="background: #fff;border: 0px solid #fff;">
                            <div class="panel-heading" style="background: #ddd;height: 47px;"><h4 style="margin-top:0px;text-align: center;" >Notice</h4>
                            </div>
                            <div class="panel-body" style="color: black;">
                                <?=get_option('notice')?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section>
@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
        }

        .header-navbar {
            line-height: 3;
            padding: 0 40px;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            position: fixed;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .zk-logo {
            mask-image: url('https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/logo_mask.png');
            -webkit-mask-image: url('https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/logo_mask.png');
            -webkit-mask-size: 100%;
            mask-size: 100%;
        }

        .row {
            padding: 0;
            margin: 0;
        }

        .row > * {
            padding: 0;
        }

        .article-post {
            width: 100%;
        }

        .article-title{
            padding: 10px 0;
            font-size:30px;
            color:rgb(199, 43, 58);
            font-weight: bolder;
        }

        .article-date{
            color:#A0A0A0;
            text-align:right;
        }
        .article-keywords{
            font-weight: bolder;
        }

        .article-content p{
            text-indent :2em;
        }

        .article-content iframe{
            aspect-ratio:16/9;
            width:100%;
            margin-left: -2em
        }


        .article-content img{
            max-width: 100%;
            height: auto;
            margin-left: -2em
        }

        .search-panel{
            background-color:white;
        }

        .search-panel-title{
            font-size:20px;
            line-height:50px;
            padding: 0 20px;
            font-weight: bolder;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            background-color: rgb(229,229,229)
        }

        .search-panel-content{
            padding:20px 20px 5px 20px;
        }

    </style>
<body>
@include('common.header')

<div class="row"
     style="padding-top: 124px; justify-content: center;background-color:rgb(242,242,242);flex-grow:1; min-height: 100vh">
    <div class="row" style="min-height:100%;width: 66.66%">
        <div class="col-8" style="">
            <div>
                @if($article->cover)
                    <img class="article-post" src="{{$article->cover->access_url}}" alt=""/>
                @endif
            </div>
            <div class="article-title">
                {{$article->title}}
            </div>
            <div>
                <div class="row" style="justify-content: end">
                    <div class="col-6 article-keywords">{{$article->keywords}}</div>
                    <div class="col-6 article-date">{{$article->created_at}}</div>
                </div>

            </div>
            <div class="article-content" style="margin-top: 20px">
                {!! $article->content  !!}
            </div>
        </div>
        <div class="col-4" style="padding-left: 10px">
            <div class="search-panel" style="margin-top:0">
                <div class="search-panel-title">
                    搜索
                </div>
                <div class="search-panel-content">
                    <div class="input-group mb-3" style="background-color:white; border-radius:3px;">
                        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="btn-serch">
                        <button class="btn btn-danger" type="button" id="btn-serch" aria-label="搜索">搜索</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>

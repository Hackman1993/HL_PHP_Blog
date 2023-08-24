<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>云南智控科技有限公司 - 搜索</title>
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

        .article-title {
            padding: 10px 0;
            font-size: 30px;
            color: rgb(199, 43, 58);
            font-weight: bolder;
        }

        .article-date {
            color: #A0A0A0;
            text-align: right;
        }

        .article-keywords {
            font-weight: bolder;
        }

        .article-content p {
            text-indent: 2em;
        }

        .article-content iframe {
            aspect-ratio: 16/9;
            width: 100%;
            margin-left: -2em
        }


        .article-content img {
            max-width: 100%;
            height: auto;
            margin-left: -2em
        }

        .article-side-panel-item {
            margin-bottom: 20px;
        }

        .search-panel {
            background-color: white;
        }

        .search-panel-title {
            font-size: 20px;
            line-height: 50px;
            padding: 0 20px;
            font-weight: bolder;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            background-color: rgb(229, 229, 229)
        }

        .search-panel-content {
            padding: 20px 20px 5px 20px;
        }

        .article-abstract {
            -webkit-line-clamp: 2;
            display: -webkit-box;
            overflow: hidden;
            -webkit-box-orient: vertical;
        }

        .article-item {
            height: 200px;
            overflow: hidden;
        }

        .article-item-background {
            height: 100%;
            background-color: white;
        }

        .article-cover-image {
            width: 100%;
            aspect-audio: 16/9;
        }

        .article-cover-title {
            font-size: 20px;
            font-weight: bolder;
            line-height: 40px;
            color: rgb(196, 28, 43);
        }

        .article-cover-title-wrapper {
            flex-grow: 1;
        }
    </style>

<body>
@include('common.header')

<div class="row"
     style="padding-top: 124px; justify-content: center;background-color:rgb(242,242,242);flex-grow:1; min-height: 100vh; align-items: center">
    <div class="col-sm-12 col-md-8">
        <div class="row" style="min-height:100%; flex-direction: row-reverse">
            <div class="col-12 col-md-12 article-side-panel" style="padding: 0 0.25rem">
                @include('common.search', ['search' => $search])
            </div>
            <div class="col-12" style="display: flex; flex-wrap: wrap">
                @foreach($articles as $article)
                    <div class="col-lg-6 article-item px-1" style="margin-top: 10px">
                        <div class="article-item-background" style="padding: 10px">
                            <a>
                                <div class="row" style="flex-wrap: nowrap; align-items: center;height: 100%">
                                    @if($article->cover)
                                        <div class="col-4">
                                            <img src="{{$article->cover->access_url}}" class="article-cover-image"/>
                                        </div>
                                    @endif
                                    <div class="col-8"
                                         style="padding-left: 20px;display:flex; flex-direction:column; flex-grow:1; height: 100%">
                                        <div style="align-items:center">
                                            <div class="article-cover-title-wrapper">
                                                <span class="article-cover-title">{{ $article->title }}</span>
                                            </div>
                                            <i class="fa-solid fa-angle-right" style="margin-right: 10px"></i>
                                        </div>
                                        <div class="full-width" style="align-items:center; flex-grow:1;">
                                            <div class="article-abstract">
                                                {{ $article->abstract}}
                                            </div>
                                        </div>
                                        <div class="full-width">
                                            <div :span="24" class="full-width" style="font-weight: bolder">
                                                关键词：
                                            </div>
                                            <div :span="24">
                                                <hr style="margin:0"/>
                                            </div>
                                            <div :span="24" style="overflow:hidden;">
                                                {{$article->keywords}}{!! "&nbsp;" !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="col-12" style="margin-top: 20px; display:flex; justify-content: center">
                    <nav>
                        <ul class="pagination" style="justify-content:center">
                            <li class="page-item">
                                <a class="page-link {{$articles->currentPage()==1? "disabled":""}}" href="/search?page={{$articles->currentPage()-1 < 1? 1:$articles->currentPage()-1}}{{isset($search)? "&search=".$search:""}}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @php
                                $page_begin = $articles->currentPage()-2>1? $articles->currentPage()-2:1;
                                $page_end = $page_begin+4 > $articles->lastPage()?  $articles->lastPage(): $page_begin+4
                            @endphp
                            @for($i = $page_begin; $i <= $page_end; $i++)
                                <li @class(["page-item", "active"=> $i == $articles->currentPage()])>
                                    <a class="page-link" href="/search?page={{$i}}{{isset($search)? "&search=".$search:""}}">{{$i}}</a>
                                </li>
                            @endfor

                            <li class="page-item">
                                <a class="page-link {{$articles->lastPage() == $articles->currentPage()? "disabled":""}}" href="/search?page={{$articles->currentPage()+1 > $page_end? $page_end:$articles->currentPage()+1}}{{isset($search)? "&search=".$search:""}}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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

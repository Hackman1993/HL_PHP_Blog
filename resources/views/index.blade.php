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

        .page-section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: left;
            align-items: center;
        }

        .section-1 {
            background-image: url('https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/section1_bg.png');
            background-attachment: fixed;
            background-position: center;
        }

        .flag-text {
            font-size: 70px;
            font-weight: bold;
            color: rgb(39, 58, 153);
        }

        .darkred-text {
            color: darkred;
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

        #section-3-row {
            background-image: url("https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/case_show_banner_bg.png");
            background-size: 100% 100%;
            flex-grow: 1;
            align-items: center;
            min-height: 0.34vh;
            width: 100%;
        }

        .case_category {
            flex-grow: 1;
            position: relative;
            background-size: 100% 100%;
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .case_category div {
            text-align: center;
            font-size: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bolder;
        }

        .friend-link {
            color: white;
            line-height: 2;
            text-decoration: none;
        }

        .friend-link:hover{
            color: darkgray;
        }
        @media (max-width: 992px){
            .case_category{
                padding: 50px 0;
            }
        }
    </style>
<body>
@include('common.header')
<section class="page-section section-1" style="justify-content: center">
    <div class="row" style="width: 100%;">
        <div class="col-1">&nbsp;</div>
        <div class="col-11">
            <span class="flag-text darkred-text">智</span>
            <span class="flag-text">你所想</span>
            <br/>
            <span class="darkred-text flag-text">&nbsp;&nbsp;&nbsp;&nbsp;控</span>
            <span class="flag-text">你所见</span>
        </div>
    </div>
</section>

<section id="section2" class="page-section">
    <div class="row row-cols-24" style="min-height: 100vh; flex-grow: 1">
        <div class="col offset-1" style="display:flex; flex-direction:column;border-left:2px solid rgb(243,243,243)">
            <div class="row"
                 style="height:164px; justify-content:center;padding-top:64px;font-size:25px; font-weight:bold; line-height:3; border-bottom:2px solid rgb(243,243,243)">
                <div class="col" style="height:100px">
                    <div
                        style="width:max-content;height:100%;border-bottom:4px solid rgb(81,119,246);display:flex;align-items:center; padding: 24px">
                        关于我们
                    </div>
                </div>
                <div class="col"
                     style="text-align:right;display:flex;align-items:center; justify-content:right; padding-right: 50px">
                    About us
                </div>
            </div>
            <div class="row"
                 style="align-items:center; height:100%; padding:40px 0; background-color:rgb(248,253,255)">
                <div class="col-md-6" style="padding: 40px">
                    <div class="zk-logo" style="background-color: #C30D23; width: 128px; height: 64px"></div>
                    <p>
                        云南智控科技有限公司成立于2013年，位于昆明市五华区金鼎科技园20号平台，主营展厅场馆建设与基础教育综合服务。是一家致力教育、科技、文化融合的服务型企业。
                    </p>
                    <p>
                        公司通过了ISO9001/14001/45001质量管理体系认证、获得了住建部颁发的电子与智能化工程专业承包二级资质、中国展览馆协会颁发的展览工程企业一级资质、展览陈列工程设计与施工一体化一级资质、2019年申报并通过了科普产品国家地方联合工程研究中心考核成为云南分中心。
                    </p>
                    <p>
                        公司目前拥有教育服务、策划设计、影视制作、软件开发、工程实施等专业团队。缴纳社保人员35人，均毕业于相关院校及专业，其中硕士2人，本科26人；持有包括：注册会计师、建造师执业资格、安全员、教师资格，等执业资格证书。
                    </p>
                </div>
                <div class="col-md-6" style="padding:40px 160px 40px 40px; text-align:center">
                    <img src="https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/section1_bg.png"
                         style="width:100%;box-shadow:40px 20px 2px rgb(15,80,184); height:100%;" alt=""/>
                </div>

            </div>
        </div>
    </div>
</section>
<section data-scroll-section id="section3" style="flex-direction:column" class="page-section">
    <div id="section-3-row" style="padding-top: 64px">
        <div
            style="width: 100%;height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: flex-end">
            <div style="padding-right: 50px">
                <div class="row" style="flex-direction: row; justify-content: flex-end;font-size: 40px">
                    <span
                        style="padding: 0 10px; font-weight: bold; color: white;width: unset">案例展示</span>
                    <div
                        style="display:inline;margin:auto 10px; width: 20px; height:20px; border-radius: 50%;background-color: white"></div>
                    <span style="padding:0 10px; color:white;width: unset; text-align: right">THE CASE SHOWS</span>
                </div>
                <div class="row" style="align-content:end;align-items: center">
                    <div
                        style="flex-grow:1;width:auto;align-items: center; height: 1px; border-bottom: 1px solid white"></div>
                    <div style="width:auto;font-size:11px; padding:0 10px; color:white">INTELLIGENT CONTROL</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="flex-grow: 2; width: 100%">
        <div class="case_category col-12 col-xs-6 col-sm-6 col-md-6 col-lg-3"
             style="background-image: url(https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/case_show_category_bg1.png)">
            <div style="width: 80%">
                <p>策划设计、施工、维护<br/>一体化服务 <br/></p>
                <p style="font-size: 15px;font-weight: normal">INTEGRATED SERVICES OF PLANNING, DESIGN,CONSTRUCTION<br/>
                    AND MAINTENANCE</p>
                <div class="row" style="width:50%;height: 1px; border-bottom: 1px solid white"></div>
            </div>
        </div>
        <div class="case_category col-12 col-xs-6 col-sm-6 col-md-6 col-lg-3"
             style="background-image: url(https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/case_show_category_bg2.png)">
            <div style="width: 80%">
                <p>策划设计、施工、维护<br/>一体化服务 <br/></p>
                <p style="font-size: 15px;font-weight: normal">INTEGRATED SERVICES OF PLANNING, DESIGN,CONSTRUCTION<br/>
                    AND MAINTENANCE</p>
                <div class="row" style="width:50%;height: 1px; border-bottom: 1px solid white"></div>
            </div>
        </div>
        <div class="case_category  col-12 col-xs-6 col-sm-6 col-md-6 col-lg-3"
             style="background-image: url(https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/case_show_category_bg3.png)">
            <div style="width: 80%">
                <p>策划设计、施工、维护<br/>一体化服务 <br/></p>
                <p style="font-size: 15px;font-weight: normal">INTEGRATED SERVICES OF PLANNING, DESIGN,CONSTRUCTION<br/>
                    AND MAINTENANCE</p>
                <div class="row" style="width:50%;height: 1px; border-bottom: 1px solid white"></div>
            </div>
        </div>
        <div class="case_category  col-12 col-xs-6 col-sm-6 col-md-6 col-lg-3"
             style="background-image: url(https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/case_show_category_bg4.png)">
            <div style="width: 80%">
                <p>策划设计、施工、维护<br/>一体化服务 <br/></p>
                <p style="font-size: 15px;font-weight: normal">INTEGRATED SERVICES OF PLANNING, DESIGN,CONSTRUCTION<br/>
                    AND MAINTENANCE</p>
                <div class="row" style="width:50%;height: 1px; border-bottom: 1px solid white"></div>
            </div>
        </div>
        <div class="case_category col-12 col-xs-6 col-sm-6 col-md-6 col-lg-3"
             style="background-image: url(https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/case_show_category_bg5.png)">
            <div style="width: 80%">
                <p>策划设计、施工、维护<br/>一体化服务 <br/></p>
                <p style="font-size: 15px;font-weight: normal">INTEGRATED SERVICES OF PLANNING, DESIGN,CONSTRUCTION<br/>
                    AND MAINTENANCE</p>
                <div class="row" style="width:50%;height: 1px; border-bottom: 1px solid white"></div>
            </div>
        </div>
        <div class="case_category col-12 col-xs-6 col-sm-6 col-md-6 col-lg-3"
             style="background-image: url(https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/case_show_category_bg6.png)">
            <div style="width: 80%">
                <p>策划设计、施工、维护<br/>一体化服务 <br/></p>
                <p style="font-size: 15px;font-weight: normal">INTEGRATED SERVICES OF PLANNING, DESIGN,CONSTRUCTION<br/>
                    AND MAINTENANCE</p>
                <div class="row" style="width:50%;height: 1px; border-bottom: 1px solid white"></div>
            </div>
        </div>
        <div class="case_category col-12 col-xs-6 col-sm-6 col-md-6 col-lg-3"
             style="background-image: url(https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/case_show_category_bg7.png)">
            <div style="width: 80%">
                <p>策划设计、施工、维护<br/>一体化服务 <br/></p>
                <p style="font-size: 15px;font-weight: normal">INTEGRATED SERVICES OF PLANNING, DESIGN,CONSTRUCTION<br/>
                    AND MAINTENANCE</p>
                <div class="row" style="width:50%;height: 1px; border-bottom: 1px solid white"></div>
            </div>
        </div>
        <div class="case_category col-12 col-xs-6 col-sm-6 col-md-6 col-lg-3"
             style="background-image: url(https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/case_show_category_bg8.png)">
            <div style="width: 80%">
                <p>策划设计、施工、维护<br/>一体化服务 <br/></p>
                <p style="font-size: 15px;font-weight: normal">INTEGRATED SERVICES OF PLANNING, DESIGN,CONSTRUCTION<br/>
                    AND MAINTENANCE</p>
                <div class="row" style="width:50%;height: 1px; border-bottom: 1px solid white"></div>
            </div>
        </div>
    </div>
</section>
<section id="sec4" class="page-section">
    <div class="row" style="justify-content: center; flex-grow:1; background-image:url('https://zk-tec.obs.cn-south-1.myhuaweicloud.com/static/flag_banner_bg.png'); min-height:300px; background-size:100% 100%; align-items:center; width: 100%">
        <div style="height:auto; width: 90%">
            <div class="zk-logo" style="background-color: #C30D23; width: 128px; height: 64px"></div>
            <div style="margin-top:20px">
                <span style="color:rgb(17,76,175); font-size:50px;font-weight:bold">以科技为美 为价值而生</span>
            </div>
        </div>
    </div>
    <div style="background-color:rgb(39,46,59);width: 100%; height: 50%">
        <div style="margin:24px 50px;">
            <div class="row" style="height:64px; align-items: center">
                <div class="zk-logo" style="background-color: #C30D23; width: 128px; height: 64px"></div>
            </div>
            <hr style="color: white"/>
            <div class="row">
                <div>
                <a class="friend-link" href="#">关于我们</a>
                <a class="friend-link" href="#">关于我们</a>
                <a class="friend-link" href="#">关于我们</a>
                <a class="friend-link" href="#">关于我们</a>
                </div>
            </div>
            <hr style="color: white"/>
            <div class="row" style="flex-direction:column">
                <div style="color:rgb(204,204,204); font-size: 20px;margin: 20px 0">联系我们</div>
                <span style="color:rgb(143,143,143); margin-bottom:0">云南省昆明市五华区金鼎山北路金鼎科技园20号平台G座5楼<br/>传真:
                    +8619989975648<br/>邮箱: +8619989975648@163.com
                </span>
            </div>
            <hr style="color: white"/>
            <div class="row" style="flex-direction:column">
                <span style="color:rgb(204,204,204); margin-bottom:0">版权所有：云南智控科技有限公司 &copy;
                    Yunnan
                    Intelligence Control Technology Co.,LTD<br/></span>
                <span style="color:rgb(204,204,204); margin-bottom:0">滇ICP备2022000967号</span>
            </div>
            <div class="row" style="align-items: center">
                <hr style="color: white; margin: 0 10px 0 0; flex-grow: 1; width: auto; height: 1px"/>
                <span style="color:rgb(90,95,109);width: auto">我是有底线的</span>
                <hr style="color: white; margin: 0 0 0 10px; flex-grow: 1;width: auto;  height: 1px"/>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>

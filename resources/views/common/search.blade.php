<div class="article-side-panel-item">
    <div class="search-panel" style="margin-top:0">
        <div class="search-panel-title">
            搜索
        </div>
        <div class="search-panel-content">
            <div class="input-group mb-3" style="background-color:white; border-radius:3px;">
                <input id="search-input" type="text" class="form-control" placeholder="" value="{{isset($search)? $search:""}}"
                       aria-label="Example text with button addon" aria-describedby="btn-serch">
                <script type="text/javascript">
                    function test(){
                        console.log((document.querySelector("#search-input").value === ""? "": "&search=" + document.querySelector("#search-input").value))
                        document.location = "/search" + (document.querySelector("#search-input").value === ""? "": "?search=" + document.querySelector("#search-input").value)
                    }
                </script>
                <button class="btn btn-danger" type="button" id="btn-serch" aria-label="搜索" onclick="test()">搜索</button>
            </div>
        </div>
    </div>
</div>

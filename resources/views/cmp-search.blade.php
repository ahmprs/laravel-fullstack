<!-- SEARCH BOX -->
<div id="{{$id}}" class="d-inline">
    <input type="text" name="" id="txtSearch" placeholder="SEARCH POSTS, COMMENTS, ARTICLES, etc.">
    <button class="btn btn-primary" id='btnSearch' onclick="search();">
    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"></path>
        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"></path>
    </svg>
    </button>
</div>

<script>
    function search() {
        var txt = $("#txtSearch").val();
        $("#div_search_results")
            .html("")
            .append($("<a href='/about-us'></a>").text("ABOUT US"));
    }
</script>
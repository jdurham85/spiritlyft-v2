<style>
    #outer_header {
        float: left;
        width: 100%;
    }

    #logo {
        float: left;
        width: 60px;
        height: 60px;
        padding: .2em;
    }

    .title {
        float: left;
        font-weight: bold;
        font-size: 40px;
        margin: .1em auto;
        text-align: center;
        /*width: 72.8%;*/
        width: 100%;
        font-family: cursive;
        color: white;
        border: none;
    }
</style>
<div id="outer_header">
    <!-- img alt="" id="logo" src="image/spiritlyft.png"/ -->
    <div class="title">SpiritLyft</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var windowWidth = $(this).width();
        console.log(windowWidth);
        if (windowWidth > 1024) {
            $(".body").css("width", "600px");
            $(".body").css("float", "none");
            $(".body").css("margin", "auto");
        } else {
            $(".body").css("width", "100%");
            $(".body").css("float", "left");
        }
    });
</script>
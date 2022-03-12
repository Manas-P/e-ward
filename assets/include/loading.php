<!-- Temporary loading delay for sending mail -->

<div class="loading loading-hide">
    <div class="loading-overlay"></div>
    <div class="gif">
        <img src="../../images/loading5.gif" alt="loading gif">
    </div>
</div>


<script>
    function loader(){
        document.querySelector(".loading").classList.remove("loading-hide");
        document.querySelector("body").style.pointerEvents = "none";
        const timeout = setTimeout(closeLoader, 20000);
    }
    function closeLoader(){
        document.querySelector(".loading").classList.add("loading-hide");
        document.querySelector("body").style.pointerEvents = "auto";
    }
</script>

<!-- NB:- Add @include loading(); on scss -->
<!-- NB:- Add onclick="loader()" to the button -->
<p class="center">Burkov&reg; Все права защищены <?= date("Y") ?><p>
<p class="center">
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
            alt="Valid CSS!" />
    </a>
</p>
<script>
    var messages = [<?= $messages ?>];

    messages.forEach(function(msg, i, messages) {
        if (msg != '') alert(msg);
    });    
</script>  
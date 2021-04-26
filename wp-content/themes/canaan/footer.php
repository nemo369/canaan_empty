<?php
defined('ABSPATH') || die();
?>
</div>
<!-- end of sitcky-footer -->

<footer>
    <div class="bottom tac">
        Dev: <a class="nemo-link" target="_blank" href="https://www.naamanfrenkel.dev" rel="noopener noreferrer">nemo</a>
    </div>

</footer>

<!-- end of app -->
</div>

<?php
wp_footer();
echo '<a href="https://naamanfrenkel.dev/" style="display:none; font-size:0px; color:transparent; visibility:hidden;"> Made By Naaman Frenkel; מתכנת נעמן פרנקל </a>';
if (WP_DEBUG === true) {
?>
    <!-- if development -->
    <script type="module" src="http://localhost:3000/@vite/client"></script>
    <script type="module" src="http://localhost:3000/main.js"></script>
<?php
}

?>
</body>

</html>
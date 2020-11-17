<?php
defined('ABSPATH') || die();
?>
</div>
<!-- end of sitcky-footer -->

<footer>
    <div class="bottom tac">
        Dev: <a class="nemo-link" target="_blank" href="https://www.naamanfrenkel.dev"  rel="noopener noreferrer">nemo</a>
    </div>

</footer>

<!-- end of app -->
</div>
<?php
$s = array();
$s['mandatory_not_full'] = pll__('התגלו שגיאות במילוי הטופס אנא חזור ותקן');
$s['ajaxing'] = pll__('שולח אנא המתן');
$s['success'] = pll__('ההודעה נשלחה בהצלחה, אנו ניצור אתכם קשר בהקדם');
$s['nl_success'] = pll__('ההרשמה בוצעה בהצלחה');
$s['fail'] = pll__('השליחה נכשלה, אנא נסו במועד מאוחד יותר');
$s['fail_fullname'] = pll__('חסר שדה שם מלא');
$s['fail_phone'] = pll__('חסר שדה טלפון');
$s['phone_only_number'] = pll__('יש להזין את הטלפון אך ורק בספרות');
$s['verifymail'] = pll__('אנא בדוק את תקינות כתובת המייל');
$s['verifyphone'] = pll__('אנא בדוק את תקינות מספר הטלפון');
$s['agree_to_terms'] = pll__('יש לאשר קבלת חומר פרסומי');


?>
<!-- <script type="text/javascript">
    var formStrings = <?php echo json_encode($s) ?>;
</script> -->

<?php
wp_footer();
echo '<span style="display:none; font-size:0px; color:transparent; visibility:hidden;"> Made By Naaman Frenkel </span>';
?>
</body>

</html>
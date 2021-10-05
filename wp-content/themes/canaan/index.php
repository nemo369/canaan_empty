<?php
if (!defined('ABSPATH')) {
    die();
}

$text = 'מכון פיזיותרפיה פיזיו אנד מור הינו מרפאה חדשנית ומקצועית, הממוקמת בשכונת המשתלה בתל אביב.';
get_header();
?>
<div class="px-6 py16">

    <h3 class="mb-6">טיפוגרפיה</h3>
    <p class="mb-2"><strong></strong></p>
    <p class="max-w-sm">כמו בכל המערכת (Design System), יש להשתמש במרווחים וגדלים המתחלקים ב-4.
        היררכיית הטיפוגרפיה וסגנונות הטקסט חייבים להשתמש באותה חוקיות.
        גודל הטקסט ובעיקר גובה השורה (Line Height) הם שייקבעו את הסדר והעקביות.</p>

    <div class="flex flex-col gap-y-4 max-w-sm mx-auto mt-16">
        <h1 class="h1 pb-3"><?= $text; ?></h1>
        <hr class="border-gray-300">
        <h2 class="h2 pb-3"><?= $text; ?></h2>
        <hr class="border-gray-300">
        <h3 class="h3 pb-3"><?= $text; ?></h3>
        <hr class="border-gray-300">
        <h4 class="h4 pb-3"><?= $text; ?></h4>
        <hr class="border-gray-300">
        <h5 class="h5 pb-3"><?= $text; ?></h5>
        <hr class="border-gray-300">
        <h6 class="h6 pb-3"><?= $text; ?></h6>
        <hr class="border-gray-300">
        <p class="body-1 pb-3 font-bold"><?= $text; ?></p>
        <hr class="border-gray-300">
        <p class="body-2 pb-3"><?= $text; ?></p>
        <hr class="border-gray-300">
        <p class="body-3 pb-3 text-base font-bold"><?= $text; ?></p>
        <hr class="border-gray-300">
        <p class="body-4 pb-3 text-base"><?= $text; ?></p>
        <hr class="border-gray-300">
    </div>
</div>

<h2 class="h1 my-6">צבעים</h2>
<div class="flex mx-auto gap-x-4 justify-center">
    <?php
    $colors = [
        'bg-blue-700' => '#08BE7C',
        'bg-blue-300' => '#BF2600',
        'bg-black' => '#fbb32e',
        'bg-gray' => '#fbb32e',
    ];
    foreach ($colors as $key => $color) {
    ?>
        <div>
            <div class="w-20 h-20 rounded <?= $key; ?>"></div>
            <p class="text-<?= $key; ?>"><?= $color; ?></p>
        </div>
    <?php
    }
    ?>

</div>

<div class="flex mx-auto mt-16">
    <h2 class="h2 mt-6 mb-2">סרגל אפורים</h2>
    <div class="flex mx-auto gap-x-4">
        <?php
        $colors = [
            'bg-gray-50' => '#08BE7C',
            'bg-gray-100' => '#BF2600',
            'bg-gray-200' => '#fbb32e',
            'bg-gray-300' => '#fbb32e',
            'bg-gray-400' => '#fbb32e',
        ];
        foreach ($colors as $key => $color) {
        ?>
            <div>
                <div class="w-20 h-20 rounded <?= $key; ?>"></div>
                <p class="text-<?= $key; ?>"><?= $color; ?></p>
            </div>
        <?php
        }
        ?>

    </div>

</div>
<div class="flex mx-auto mt-16">
    <h2 class="h2 mt-6 mb-2">אינדיקציות</h2>
    <div class="flex mx-auto gap-x-4 justify-center">
        <?php
        $colors = [
            'bg-green' => '#08BE7C',
            'bg-red' => '#BF2600',
            'bg-orange' => '#fbb32e',
        ];
        foreach ($colors as $key => $color) {
        ?>
            <div>
                <div class="w-20 h-20 rounded <?= $key; ?>"></div>
                <p class="text-<?= $key; ?>"><?= $color; ?></p>
            </div>
        <?php
        }
        ?>
    </div>
</div>


<h2 class="mt-20 h3"> כפתורים</h2>
<p>לכל הכפתורים יהיה border radius של 4 פיקסל, ללא הצללה.
    רוחב הכפתור יתחיל במינימום של 80 פיקסל, ולאחר מכן ייקבע לפי padding של 16 פיקסלים מהצדדים.
    טקסט הכפתור יהיה תמיד 14px, Bold בצבע לבן.</p>

<div class="flex justify-around mt-16">

    <button class="btn btn--prim">פעולה עיקרית</button>
    <button class="btn btn--sec"> פעולה מישנית</button>
    <button class="btn btn--sec" disabled> פעולה disabled</button>
    <a href="#" target="_blank" rel="noopener noreferrer" class="a">הייפר לינק</a>
</div>
<?php

get_footer();

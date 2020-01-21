<?php
/**
 * Apps BMI
 *
 * This template can be overridden by copying it to your-child-theme/templates/apps-bmi.php.
 *
 * HOWEVER, on occasion Herbs will need to update template files and you
 * will need to copy the new files to your child theme to maintain compatibility.
 *
 * @author   Herbs
 * @version  1.0.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

// Enqueue the Videos Playlist Js file
wp_enqueue_script( 'tie-js-apps' );
?>

<h1>Kalkulator BMI</h1>
<p>Tinggi Anda: <input type="text" id="height"/>
	<select type="multiple" id="heightunits">
		<option value="metres" selected="selected">meter</option>
		<option value="inches">inci</option>
	</select>
		</p>
<p>Berat Anda: <input type="text" id="weight"/>
	<select type="multiple" id="weightunits">
		<option value="kg" selected="selected">kilo</option>
		<option value="lb">pound</option>
	</select>
</p>
<input type="submit" value="Hitung" onclick="computeBMI();">
<h1>Hasil BMI Anda adalah: <span id="output">?</span></h1>

<h2>Artinya Anda: <span id="comment"> ?</span> </h2>

<p id="description">&nbsp;</p>
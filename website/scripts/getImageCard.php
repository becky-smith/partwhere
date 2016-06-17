<?php
	// select part type - may need to drill down levels
	function getImageCard($image, $text, $details, $id, $eventHandler)
	{
		$output = '<div class="col s6 m3 l2">';
		$output .= '<div class="card small">';
		$output .= '<div class="card-image">';
    $output .= '<img class="activator" src="img/' . $image . '">';
		$output .= '</div>';
		$output .= '<div class="card-content">' . $text . '</div>';
		$output .= '<div class="card-reveal">';
		$output .= '<span class="card-title grey-text text-darken-4">' . $text . '<i class="material-icons right">close</i></span>';
		$output .= '<p>'. $details .'</p>';
		$output .= '</div>';
    $output .= '<div class="card-action">';
    $output .= '<a class="btn-floating waves-effect waves-teal" onclick="';
    $output .= $eventHandler . '"><i class="small material-icons">play_arrow</i></a>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
?>

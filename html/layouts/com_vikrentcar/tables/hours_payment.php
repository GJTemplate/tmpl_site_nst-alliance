<?php
	/**
	 * @package     ${NAMESPACE}
	 * @subpackage
	 *
	 * @copyright   A copyright
	 * @license     A "Slug" license name e.g. GPL2
	 */
	
	extract( $displayData );


?>

<tr>
    <td>
		<span class="data-qty">
			<?= $hoursTXR // Кол-во часов   ?>
		</span>
    </td>
    <td>
        <span class="amount-rate">
	        <span class="currencySymbol">
		        <?= $currencysymb ?>
	        </span>
	        <?php
		        #  $ehours['cost']      - тоимость за вче дополнительные часы
		        ##  $ehours['ehours']    - Количество дополнительныз часов
		        $hr_cost = $ehours[ 'cost' ] / $ehours[ 'ehours' ]; ?>
	        <?= $hr_cost //стоимость 1 час   ?>
		</span>
    </td>
    <td>
		<span class="total-rate">
			<span class="currencySymbol">
				<?= $currencysymb ?>
			</span>
			<?php // Итого за часы
			$cost_Time = VikRentCar::numberFormat( $ehours[ 'cost' ] );?>
			
			<?= $cost_Time ?>
		</span>
    </td>
</tr>
<tr>
	<td colspan="3" class="divider"></td>
</tr>

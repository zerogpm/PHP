<?PHP






/**
* Create a function to sort and order a complex array containing customers.
*
* Sort the retailers like this, so that resellers come first, followed by B2B resellers, followed by referrers
*
* RESELLERS
* 	sort resellers so that
* 		all resellers with 100,000 in revenue come first, and then are sorted by name,
* 		followed by all resellers with less than 100,000 in revenue, and then sorted by name.
* B2B RESELLERS
* 	sort b2b resellers by revenue
* REFERRERS
*  sort referrers by the total number of referrals they have
*  if they are tied, sort by name (alphabetical)
*
* Pay attention to efficiency - i.e, try to do the sort in a single pass, try not to create multiple copies of the same array.
* This function may be asked to sort very large arrays.
*
* @param array $retailersArray An array containing a set of customers
* @return array An array containing the correctly ordered set of customers.
*
*/
function sortRetailers($retailersArray)
{
	//key to be sorted
	$key = "Revenue";

	//create a temp array to hold it
	foreach($retailersArray as $k =>$v){
		$temp1[] = strtolower($v[$key]);
	}
	//sorted from high to low
	arsort($temp1);

	//create a new array to hold sorted temp
	foreach($temp1 as $k=>$v) {
		$temp2[] = $retailersArray[$k];
	}

	$TempArrayLength = count($temp2);

	for($i = 0; $i < $TempArrayLength; $i++) {
		if($temp2[$i]['Revenue'] >= 100000.00) {
			array_unshift($temp2, $temp2[$i]);
			unset($temp2[$i]);
			continue;
		}
	}
}

# Use this array (or make your own) for the two retailer bonus questions.
$retailers = array(
array(
"ID"			=> 1001,
"Retailer Name" => "Gibson Pharma",
"Type" 			=> "RESELLER",
"Revenue" 		=> 198000.00,
"Referrals" 	=> array(1009, 1005, 2004)
),
array(
"ID"			=> 1002,
"Retailer Name" => "Charles Pharma",
"Type" 			=> "RESELLER",
"Revenue" 		=> 10000.00,
"Referrals" 	=> array(1039, 10035, 2034)
),
array(
"ID"			=> 1003,
"Retailer Name" => "Real Ace Venture",
"Type" 			=> "B2B SUPPLIER",
"Revenue" 		=> 98000.00,
"Referrals" 	=> array(2003)
),
array(
"ID"			=> 1004,
"Retailer Name" => "Genuine Wholesale",
"Type" 			=> "B2B RESELLER",
"Revenue" 		=> 1998000.00,
"Referrals" 	=> array()
),
array(
"ID"			=> 1005,
"Retailer Name" => "Zed Happening",
"Type" 			=> "REFERRER",
"Revenue" 		=> 0.0,
"Referrals" 	=> array(1019, 1015, 2014, 8000, 11000, 4001)
),
array(
"ID"			=> 1005,
"Retailer Name" => "Sadie Quick",
"Type" 			=> "REFERRER",
"Revenue" 		=> 0.0,
"Referrals" 	=> array(1049, 1045, 2044, 8004, 11004, 4004)
),
array(
"ID"			=> 1006,
"Retailer Name" => "Mainline Reselling Inc",
"Type" 			=> "RESELLER",
"Revenue" 		=> 128000.00,
"Referrals" 	=> array(1059, 1055, 2054)
),
array(
"ID"			=> 1001,
"Retailer Name" => "Ben User",
"Type" 			=> "REFERRER",
"Revenue" 		=> 0.0,
"Referrals" 	=> array(1409, 1405, 2404)
),
);






/**
* Create a function to transform an array in a variety of means
*
* From this format:
*
$retailers = array(
array(
"ID"			=> 1001,
"Retailer Name" => "Gibson Pharma",
"Type" 			=> "RESELLER",
"Revenue" 		=> 198000.00,
"Referrals" 	=> array(1009, 1005, 2004)
),
. . .
)

* To this format:

$retailers = array(
"rows_view"  	=> [
 						[1001, "Gibson Pharma", "RESELLER", 198000.00, "1009,1005,2004"],
 					 	[1002, "Charles Pharma Pharma", "RESELLER", 10000.00, "1009,1005,2004"],
  						...
 					]
"index_view" 	=> [
 					 	"1001" => ["Retailer Name" => "Gibson Pharma", "Type" => "RESELLER", "Revenue" => 198000.00, "Referrals" => [1039,1035,2034]] ,
 					 	"1002" => ["Retailer Name" => "Charles Pharma", "Type" => "RESELLER", "Revenue" => 10000.00, "Referrals" 	=> [1039, 10035, 2034]],
 						...
 					]
"columns_view"  => [
  						"RESELLER" => array( "ID" => [1001, 1002, ...],
											"Retailer Name" => ["Gibson Pharma", "Company 2"],
											"Revenue" => array(198000.00, 120.00)
						)
						"B2B RESELLER" => array(
							...
						)
					]
)

*
* @param array $retailersArray An array containing a set of customers
* @return array A transformed array, containing the different views of data
*
*/
function transformRetailers($retailersArray)
{
// ...
}





/**
 * Dig into an array and return the element specified by the string path
 *
 * @param Array $complex_array The complex array
 * @param String $path the path of the element to extract, e.g.  system.interface.days
 * @return Mixed The requested element
 *
 * An example:
 * php> $big_array = Array (
 *                      "system" => Array(
 *                              "interface" => Array(
 *                                      "days" => 76,
 *                                      "months" => 12,
 *                                      "weeks" => 5,
 *                              ),
 *                              "configuration" => Array(
 *										"x" => "special",
 *                                      "y" => "ordinary",
 *                              ),
 *                      ),
 *                      "alternate" => Array(
 *                              "hamburger" => Array(3,4),
 *                      ),
 *              );
 * php> print_r(extract_element($big_array, 'system.interface.days'));
 *  76
 * php> print_r(extract_element($big_array, 'alternate.hamburger'));
 *  Array
 *  (
 *     [0] => 3
 *     [1] => 4
 *  )
 *
 */
function extract_element(Array $complex_array, $path) {

}

/**
 * Caesar cipher function.
 *
 * The Caesar cipher is a Roman-era method of encrypting strings of text.
 *
 * Please write a function that will encrypt a given string according to the shift that is supplied.
 *
 * @param string $input The original text.
 * @param int $shift The required shift, the sign is used for direction.
 * @return string The encrypted text.
 *
 * An example:
 *     php> echo getCaesarCipher("Yet it moves", 3);
 * 		    Bhw lw pryhv
 */
function getCaesarCipher($input, $shift)
{
	// ...
}




/**
 * Find the densest cluster of n objects,
 * where that cluster of n objects has the smallest radius in comparison to any other cluster.
 * This is a more advanced version of an earlier question.
 *
 *
 * @param array $objects The list of objects with the name and coordinates.
 * @param int  $n The list of objects with the name and coordinate.
 * @return array The closest objects names.
 *
 * An example:
 *     php> $obj[] = ['name' => 'a', 'x' => 1, 'y' => 1];
 *     php> $obj[] = ['name' => 'b', 'x' => 1, 'y' => 2];
 *     php> $obj[] = ['name' => 'c', 'x' => 5, 'y' => 6];
 *     php> $obj[] = ['name' => 'd', 'x' => 9, 'y' => 10];
 *     php> $obj[] = ['name' => 'e', 'x' => 9, 'y' => 9];
 *     php> $obj[] = ['name' => 'f', 'x' => 8, 'y' => 8];
 *     php> = findClosestN([$obj1, $obj2, $obj3], 3)
 *     array(
 *       0 => "d",
 *       1 => "e",
 *       2 => "f"
 *     )
 */
function findClosestN(array $objects, $n)
{


}
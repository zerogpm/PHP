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

function sortRetailers($retailersArray)
{
    //key to be sorted
    $keyRevenue = "Revenue";
    $keyType    = "Type";

    //create a temp array to hold it
    foreach($retailersArray as $k =>$v){
        $RevenueTemp[] = strtolower($v[$keyRevenue]);
    }
    //sorted from high to low
    arsort($RevenueTemp);

    //create a new array to hold sorted temp
    foreach($RevenueTemp as $k=>$v) {
        $RevenueSorted[] = $retailersArray[$k];
    }


    $TempArrayLength = count($RevenueSorted);

    $ResellerSortTemp = [];
    for($i = 0; $i < $TempArrayLength; $i++) {
        if($RevenueSorted[$i][$keyRevenue] >= 100000.00 && $RevenueSorted[$i][$keyType] == 'RESELLER') {
            $ResellerSortTemp[$i] = $RevenueSorted[$i];
            continue;
        }
    }

    var_dump($ResellerSortTemp);


}

//https://www.youtube.com/watch?v=zBaHBmZLDxY

sortRetailers($retailers);
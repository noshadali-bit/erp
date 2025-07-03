<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Zoha\MetableModel;
use App\Models\Page;
use Session;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// require 'vendor/autoload.php';

use SellingPartnerApi\Api\OrdersV0Api;
use SellingPartnerApi\Configuration;
use SellingPartnerApi\Endpoint;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function submitHome(Request $request)
    {
        $files = $request->file();
        $page = Page::where('name', 'home')->first();
        $homemeta = $page->getMeta('home');
        $req = $request->all();
        $uploadedImages = $homemeta['uploadedImages'] ?? [];

        foreach ($uploadedImages as $in => $imgs) {
            if (is_array($imgs)) {
                foreach ($imgs as $ind => $images) {
                    foreach ($images as $nam => $img_value) {
                        //dd([$req[$in], $imgs]);
                        if (isset($req[$in][$ind]['index'])) {
                            $oldInx = $req[$in][$ind]['index'];
                            if ($oldInx != $ind) {
                                //$page->clearMediaCollection($nam.$ind);
                                $attachment = $page->getMedia($nam . $oldInx);
                                if ($attachment) {
                                    $uploadedImages[$in][$ind][$nam] = $attachment[0];
                                }
                            }
                        } else {
                            array_splice($uploadedImages[$in], $ind, 1);
                        }
                    }
                }
            }
        }
        //dd($uploadedImages);



        if ($files) {
            foreach ($files as $key => $file) {
                if (is_array($file)) {
                    foreach ($file as $index => $items) {
                        foreach ($items as $name => $item) {
                            $page->clearMediaCollection($name . $index);
                            $attachment = $page->addMedia($item)->toMediaCollection($name . $index);
                            $uploadedImages[$key][$index][$name] = $attachment;
                        }
                    }
                } else {
                    $page->clearMediaCollection($key);
                    $attachment = $page->addMedia($file)->toMediaCollection($key);
                    $uploadedImages[$key] = $attachment;
                }
            }
        }



        $req['uploadedImages'] = $uploadedImages;
        $page->setMeta('home', $req);
        return redirect()->route('admin_home');
    }

    public function home(Request $request)
    {
        $page = Page::where('name', 'home')->first();
        if ($page) {
            $homemeta = $page->getMeta('home');
        }
        if ($homemeta) {
            return view('admin.pages.home-page')->with('meta', $homemeta);
        } else {
            return view('admin.pages.home-page');
        }
    }





    public function submitHome2(Request $request)
    {
        $sliderFiles = $request->file('slider');
        // dd($sliderFiles);
        // $files = $request->file();
        $page = Page::where('name', 'home')->first();
        // $homemeta = $page->getMeta('home');
        $req = $request->all();
        // dd($request->all());
        // $uploadedImages = $homemeta['uploadedImages'] ?? [];

        // foreach($uploadedImages as $in => $imgs)
        // {
        //     if(is_array($imgs))
        //     {
        //         foreach($imgs as $ind => $images)
        //         {
        //             foreach($images as $nam => $img_value)
        //             {
        //                 //dd([$req[$in], $imgs]);
        //                 if(isset($req[$in][$ind]['index']))
        //                 {
        //                     $oldInx = $req[$in][$ind]['index'];
        //                     if($oldInx != $ind)
        //                     {
        //                         //$page->clearMediaCollection($nam.$ind);
        //                         $attachment = $page->getMedia($nam.$oldInx);
        //                         if($attachment)
        //                         {
        //                             $uploadedImages[$in][$ind][$nam] = $attachment[0];
        //                         }


        //                     }
        //                 }
        //                 else
        //                 {
        //                     //dd(1);
        //                     array_splice($uploadedImages[$in], $ind, 1);
        //                 }

        //             }
        //         }
        //     }
        // }
        // //dd($uploadedImages);


        $SlideImg = [];
        if ($sliderFiles) {
            foreach ($sliderFiles as $key => $file) {
                $bgImg = $file['bg_img'] ?? null;
                $slImg = $file['sl_img'] ?? null;
                if ($bgImg) {
                    $page->clearMediaCollection('background_images' . $key);
                    $attachment1 = $bgMedia = $page->addMedia($bgImg)->toMediaCollection('background_images' . $key);
                    $SlideImg[$key]['bg_img'] = $attachment1;
                    $req['slider'][$key]['bg_img'] = $attachment1;
                }
                if ($slImg) {
                    $page->clearMediaCollection('slider_images' . $key);
                    $attachment2 = $slMedia = $page->addMedia($slImg)->toMediaCollection('slider_images' . $key);
                    $SlideImg[$key]['sl_img'] = $attachment2;
                    $req['slider'][$key]['sl_img'] = $attachment2;
                }
            }
        }

        // $req['uploadedImages'] = $uploadedImages;
        $page->setMeta('home', $req);
        return redirect()->route('admin_home2');
    }

    public function home2(Request $request)
    {
        $page = Page::where('name', 'home')->first();
        if ($page) {
            $mediaItems = $page->getMedia();
        }
        if ($page) {
            $homemeta = $page->getMeta('home');
        }
        if ($homemeta) {
            return view('admin.pages.home-new')->with('meta', $homemeta)->with('mediaItems', $mediaItems);
        } else {
            return view('admin.pages.home-new');
        }
    }




    public function about(Request $request)
    {
        $page = Page::where('name', 'about')->first();
        if ($page) {
            $homemeta = $page->getMeta('about');
        }

        if ($homemeta) {
            return view('admin.pages.about-page')->with('meta', $homemeta);
        } else {
            return view('admin.pages.about-page');
        }
    }
    public function submitAbout(Request $request)
    {
        $files = $request->file();
        $page = Page::where('name', 'about')->first();
        $aboutmeta = $page->getMeta('about');
        $req = $request->all();
        $uploadedImages = $aboutmeta['uploadedImages'] ?? [];

        foreach ($uploadedImages as $in => $imgs) {
            if (is_array($imgs)) {
                foreach ($imgs as $ind => $images) {
                    foreach ($images as $nam => $img_value) {
                        //dd([$req[$in], $imgs]);
                        if (isset($req[$in][$ind]['index'])) {
                            $oldInx = $req[$in][$ind]['index'];
                            if ($oldInx != $ind) {
                                //$page->clearMediaCollection($nam.$ind);
                                $attachment = $page->getMedia($nam . $oldInx);
                                if ($attachment) {
                                    $uploadedImages[$in][$ind][$nam] = $attachment[0];
                                }
                            }
                        } else {
                            //dd(1);
                            array_splice($uploadedImages[$in], $ind, 1);
                        }
                    }
                }
            }
        }
        //dd($uploadedImages);



        if ($files) {
            foreach ($files as $key => $file) {
                if (is_array($file)) {
                    foreach ($file as $index => $items) {
                        foreach ($items as $name => $item) {
                            $page->clearMediaCollection($name . $index);
                            $attachment = $page->addMedia($item)->toMediaCollection($name . $index);
                            $uploadedImages[$key][$index][$name] = $attachment;
                        }
                    }
                } else {
                    $page->clearMediaCollection($key);
                    $attachment = $page->addMedia($file)->toMediaCollection($key);
                    $uploadedImages[$key] = $attachment;
                }
            }
        }



        $req['uploadedImages'] = $uploadedImages;
        $page->setMeta('about', $req);
        return redirect()->route('admin_about');
    }


    public function settings()
    {


        return view('admin.pages.settings');
    }
    
    public function profile()
    {


        return view('admin.pages.profile');
    }
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('profile')->with('notify_success', 'Password updated successfully.');

    }
    
    
    
    public function orders()
    {


        return view('admin.pages.orders');
    }



    public function order_download_submit(Request $request)
    {
        $setting = Setting::first();
        $marketplaceId = $request->marketplace;
        $endpoint = $this->getEndpointFromMarketplace($marketplaceId);
        // dd($endpoint);
        $config = new Configuration([
            "lwaClientId"        => $setting['lwaClientId'],
            "lwaClientSecret"    => $setting['lwaClientSecret'],
            "lwaRefreshToken"    => "Atzr|IwEBIMuHeys23bwfEbzZCZ1Rsdox8z-46ovOVwDmft7J5otsHQnM--Pn2KX3a3k1wV2PPBuZphqYXbRJVRi0WXw4vfu5JwtcB-VxeRKW9lzOb6rsv4GVK5Odx-1wxQW0bn8MvEgSfC7gy0BMa7WSnZZXC9-Fv9SPLnzORnTsm4TWJ0FdCqEuRZl5NGyCrb8nmyM_mWOnfuk13sF3R5SLGNXvubJNTMdoM5_Zpq-UOElUjkOewJHGiyZ2UcBLT9ZhMV4pBNg4tJ58-VDboLTqaYDyd54o01lcJhm4woh35We4JWUXFMzjv84Hw23QMQoo6m6t0_M",
            "awsAccessKeyId"     => $setting['awsAccessKeyId'],
            "awsSecretAccessKey" => $setting['awsSecretAccessKey'],
            "roleArn"            => $setting['roleArn'],
            "endpoint"           => $endpoint, // Update this based on the region (NA, EU, APAC)
        ]);

        $ordersApi = new OrdersV0Api($config);
        $nextToken = null;
        $lastRequestTime = null;
        $pgnum = 1;
        do {
            try {

                $fromDate =  $request->from_date;
                $toDate =  $request->to_date;
                $orderType = $request->order_type;

                $marketplaceIds = [$marketplaceId];
                $createdAfter = date('Y-m-d\TH:i:s\Z', strtotime($fromDate));
                $createdBefore = date('Y-m-d\TH:i:s\Z', strtotime($toDate));
                $orderStatuses = null;

                if ($orderType === 'un-shipped') {
                    $orderStatuses = ['Unshipped', 'PartiallyShipped'];
                } elseif ($orderType) {
                    $orderStatuses = $orderType;
                }
                // dd($orderStatuses);
                sleep(1);
                $response = $ordersApi->getOrders(
                    $marketplaceIds,
                    $createdAfter,
                    $createdBefore,
                    null,    // From date
                    null,     // To date
                    $orderStatuses, // Optional
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    $nextToken
                );
                if ($response->getPayload() != null) {
                    $nextToken = $response->getPayload()->getNextToken();
                    $orders = $response->getPayload()['orders'] ?? [];
                }
                // dd($orders);
                if (empty($orders)) {
                    // If no orders, return an error response
                    return redirect()->back()->with('notify_error', 'No Orders Found');
                }

                foreach ($orders as $order) {
                }

                // File name for the text file
                $fileName = 'orders_' . date('Y_m_d_H_i_s') . '.txt';
                $filePath = storage_path('app/public/' . $fileName);

                // Open file in write mode
                $file = fopen($filePath, 'w');

                // Define the headers
                $headers = [
                    'Order ID  ',
                    ' Purchase Date ',
                    ' Ship Service Level ',
                    ' Recipient Name ',
                    ' Shipping City ',
                    ' Shipping State/Region ',
                    ' Shipping Postal Code ',
                    ' Shipping Country ',
                    ' Ship Phone Number  ',
                    ' Shipping Address 1 ',
                    ' Shipping Address 2 ',
                    ' Shipping Address 3 ',
                    ' Currency ',
                    ' Buyer Email ',
                    ' Buyer Name ',
                    ' Buyer Phone ',
                    ' Earliest Ship Date ',
                    ' Latest Ship Date ',
                    ' Earliest Delivery Date ',
                    ' Latest Delivery Date ',
                    ' Last Update Date ',
                    ' SKU ',
                    ' Order Item Id ',
                    ' Product Name ',
                    ' Item Price ',
                    ' Quantity Purchased ',
                    ' Item Tax ',
                    ' Item Price ',
                    ' Item Price ',
                    ' Is Cancelation Requested ',
                    ' Cancelation Reason ',
                ];


                // Create a tabular header
                $headerRow = implode("\t", $headers);
                fwrite($file, $headerRow . "\n");
                fwrite($file, str_repeat('-', strlen($headerRow)) . "\n"); // Add a separator line

                // Write each order as a row
                foreach ($orders as $key => $order) {
                    sleep(1);
                    $orderArray = json_decode(json_encode($order), true);
                    // dd($orderArray);

                    $orderId = $orderArray['AmazonOrderId'] ?? null;

                    // Skip if no Order ID
                    if (!$orderId) continue;

                    // Fetch order items
                    $p_sku = $p_orderItemId = $p_productName = $p_quantityPurchased = $p_isCancelationRequested = $p_cancelationReason = 'N/A';
                    $orderItems = []; // Initialize an empty array for order items

                    try {
                        if ($orderId) {
                            $orderItemsResponse = $ordersApi->getOrderItems($orderId);
                            if (!$orderItemsResponse || empty($orderItemsResponse)) {
                                $itemArray = [];
                            } else {
                                $orderItems = $orderItemsResponse->getPayload()['order_items'][0] ?? [];
                                // if ($key < 20) {
                                // } else {
                                //     break;
                                // }
                                $itemArray = json_decode(json_encode($orderItems), true);
                            }

                            $p_sku = $itemArray['SellerSKU'] ?? 'N/A';
                            $p_orderItemId = $itemArray['OrderItemId'] ?? 'N/A';
                            $p_productName = $itemArray['Title'] ?? 'N/A';
                            $p_productPrice = $itemArray['ItemPrice']['Amount'] ?? 'N/A';
                            $p_quantityPurchased = $itemArray['QuantityOrdered'] ?? 'N/A';
                            $p_productTax = $itemArray['ItemTax']['Amount']  ?? 'N/A';
                            $p_productShippingPrice = $itemArray['ShippingPrice']['Amount']  ?? 'N/A';
                            $p_productShippingTax = $itemArray['ShippingTax']['Amount']  ?? 'N/A';
                            $p_isCancelationRequested = ($itemArray['BuyerRequestedCancel']['IsBuyerRequestedCancel'] == true) ? 'Yes' : 'No';
                            $p_cancelationReason = $itemArray['BuyerRequestedCancel']['BuyerCancelReason'] ?? 'N/A';
                        }
                    } catch (Exception $e) {
                        \Log::error("Error fetching order items for Order ID $orderId: " . $e->getMessage());
                    }

                    $shippingAddress = $orderArray['ShippingAddress'] ?? [];
                    $buyerInfo = $orderArray['BuyerInfo'] ?? [];

                    // Create the row
                    $row = [
                        $orderArray['AmazonOrderId'] ?? 'N/A',
                        $orderArray['PurchaseDate'] ?? 'N/A',
                        $orderArray['ShipServiceLevel'] ?? 'N/A',
                        $shippingAddress['Name'] ?? 'N/A',
                        $shippingAddress['City'] ?? 'N/A',
                        $shippingAddress['StateOrRegion'] ?? 'N/A',
                        $shippingAddress['PostalCode'] ?? 'N/A',
                        $shippingAddress['CountryCode'] ?? 'N/A',
                        $shippingAddress['Phone'] ?? 'N/A',
                        $shippingAddress['AddressLine1'] ?? 'N/A',
                        $shippingAddress['AddressLine2'] ?? 'N/A',
                        $shippingAddress['AddressLine3'] ?? 'N/A',
                        $orderArray['OrderTotal']['CurrencyCode'] ?? 'N/A',
                        $buyerInfo['BuyerEmail'] ?? 'N/A',
                        $buyerInfo['BuyerName'] ?? 'N/A',
                        $buyerInfo['BuyerPhone'] ?? 'N/A',
                        $orderArray['EarliestShipDate'] ?? 'N/A',
                        $orderArray['LatestShipDate'] ?? 'N/A',
                        $orderArray['EarliestDeliveryDate'] ?? 'N/A',
                        $orderArray['LatestDeliveryDate'] ?? 'N/A',
                        $orderArray['LastUpdateDate'] ?? 'N/A',
                        $orderArray['OrderTotal']['Amount'] ?? 'N/A',
                        $orderArray['NumberOfItemsShipped'] ?? 'N/A',
                        $orderArray['NumberOfItemsUnshipped'] ?? 'N/A',
                        isset($p_sku) ? $p_sku : 'N/A',
                        isset($p_orderItemId) ? $p_orderItemId : 'N/A',
                        isset($p_productName) ? $p_productName : 'N/A',
                        isset($p_productPrice) ? $p_productPrice : 'N/A',
                        isset($p_quantityPurchased) ? $p_quantityPurchased : 'N/A',
                        isset($p_productTax) ? $p_productTax : 'N/A',
                        isset($p_productShippingPrice) ? $p_productShippingPrice : 'N/A',
                        isset($p_productShippingTax) ? $p_productShippingTax : 'N/A',

                        isset($p_isCancelationRequested) ? $p_isCancelationRequested : 'N/A',
                        isset($p_cancelationReason) ? $p_cancelationReason : 'N/A',
                    ];
                    // dd($row);
                    // Write the row to the file
                    fwrite($file, implode("\t", $row) . "\n");
                }

                fclose($file);

                // Return the file as a download response
                return response()->download($filePath)->deleteFileAfterSend(true); // Automatically delete after download

            } catch (Exception $e2) {
                echo "Error fetching orders: ", $e2->getMessage(), "\n";
                return [];
            }
        } while ($nextToken != null); //do
    }


    public function getEndpointFromMarketplace($marketplaceId)
    {
        $marketplaceToEndpoint = [
            // North America (NA)
            "ATVPDKIKX0DER" => Endpoint::NA,  // United States
            "A2EUQ1WTGCTBG2" => Endpoint::NA,  // Canada
            "A1AM78C64UM0Y8" => Endpoint::NA,  // Mexico
            "A2Q3Y263D00KWC" => Endpoint::NA,  // Brazil

            // Europe (EU)
            "A1RKKUPIHCS9HS" => Endpoint::EU,  // Spain
            "A1F83G8C2ARO7P" => Endpoint::EU,  // United Kingdom
            "A13V1IB3VIYZZH" => Endpoint::EU,  // France
            "AMEN7PMS3EDWL"  => Endpoint::EU,  // Belgium
            "A1805IZSGTT6HS" => Endpoint::EU,  // Netherlands
            "A1PA6795UKMFR9" => Endpoint::EU,  // Germany
            "APJ6JRA9NG5V4"  => Endpoint::EU,  // Italy
            "A2NODRKZP88ZB9" => Endpoint::EU,  // Sweden
            "AE08WJ6YKNBMC"  => Endpoint::EU,  // South Africa
            "A1C3SOZRARQ6R3" => Endpoint::EU,  // Poland
            "ARBP9OOSHTCHU"  => Endpoint::EU,  // Egypt
            "A33AVAJ2PDY3EV" => Endpoint::EU,  // Turkey
            "A17E79C6D8DWNP" => Endpoint::EU,  // Saudi Arabia
            "A2VIGQ35RCS4UG" => Endpoint::EU,  // United Arab Emirates
            "A21TJRUUN4KGV"  => Endpoint::EU,  // India

            // Far East (APAC)
            "A19VAU5U5O7RUS" => Endpoint::FE, // Singapore
            "A39IBJ37TRP1C6" => Endpoint::FE, // Australia
            "A1VC38T7YXB528" => Endpoint::FE, // Japan
        ];

        return $marketplaceToEndpoint[$marketplaceId] ?? Endpoint::NA; // Default to NA if not found
    }

    public function submitSettings(Request $request)
    {
        $req = $request->all();
        $page = Page::where('name', 'setting')->first();

        if ($req && $page) {
            $page->setMeta('setting', $req);
            Session::flash('message', 'Service create successfully!');
            return redirect()->back();
        }

        Session::flash('message', 'Service create Failed!');
        return redirect()->back();
    }





    // For Web Start
    public function web_home()
    {
        $page = Page::where('name', 'home')->first();
        if ($page) {
            $mediaItems = $page->getMedia();
        }
        if ($page) {
            $homemeta = $page->getMeta('home');
        }
        if ($homemeta) {
            $data = json_decode($page->metarelation[0]->value, true);
            // return view('web.home')->with('data', $data)->with('mediaItems', $mediaItems);
            // return view('admin.pages.home-new')->with('meta', $homemeta)->with('mediaItems', $mediaItems);
        } else {
            // return view('web.home');
            // return view('admin.pages.home-new');
        }
    }

    public function web_about()
    {
        $page = Page::where('name', 'about')->first();
        if ($page) {
            $mediaItems = $page->getMedia();
        }
        if ($page) {
            $homemeta = $page->getMeta('about');
        }
        if ($homemeta) {
            $data = json_decode($page->metarelation[0]->value, true);
            // return view('web.about-us')->with('data', $data)->with('mediaItems', $mediaItems);
        } else {
            // return view('web.about-us');
        }
    }

    public function web_booking()
    {
        $services = Service::all();
        $page = Page::where('name', 'setting')->first();
        if ($page) {
            $homemeta = $page->getMeta('setting');
        }
        if ($homemeta) {
            $data = json_decode($page->metarelation[0]->value, true);
            // return view('web.book-an-appointment',compact('services'))->with('data', $data);
        } else {
            // return view('web.book-an-appointment',compact('services'));
        }
    }
    // For Web End
}

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <!-- Site Title -->
    <link rel="icon" href="{{ asset('uploads/default_photo') }}/{{ $default_setting->favicon }}" type="image/png" />
    <title>{{ env('APP_NAME') }} || Invoice - {{ $courier_summary->id }}</title>
    <link rel="stylesheet" href="{{ asset('admin') }}/invoice/style.css">
</head>

<body>
    <div class="tm_container">
        <div class="tm_invoice_wrap">
            <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
                <div class="tm_invoice_in">
                    <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
                        <div class="tm_invoice_left">
                            <div class="tm_logo"><img src="{{ asset('uploads/default_photo') }}/{{ $default_setting->logo_photo }}" alt="Logo"></div>
                        </div>
                        <div class="tm_invoice_right tm_text_right tm_mobile_hide">
                            <div class="tm_f50 tm_text_uppercase tm_white_color">Tracking Id - {{ $courier_summary->tracking_id }}</div>
                        </div>
                        <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
                    </div>
                    <div class="tm_invoice_info tm_mb25">
                        <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color">Courier Status: </b>{{ $courier_summary->courier_status }}</div>
                        <div class="tm_invoice_info_list tm_white_color">
                            <p class="tm_invoice_date tm_m0">Date: <b>{{ $courier_summary->created_at->format('D d,M-Y h:m:s A') }}</b></p>
                        </div>
                        <div class="tm_invoice_seperator tm_accent_bg"></div>
                    </div>
                    <div class="tm_invoice_head tm_mb10">
                        <div class="tm_invoice_left">
                        <p class="tm_mb2"><b class="tm_primary_color">From:</b></p>
                        <p>
                            <strong class="text-inverse">Branch: {{ $courier_summary->relationtosenderbranch->branch_name }} </strong><br>
                            <strong class="text-inverse">Name: {{ $courier_summary->sender_name }} </strong><br>
                            Address: {{ $courier_summary->sender_address }} <br>
                            Phone: {{ $courier_summary->sender_phone_number }} <br>
                        </p>
                        </div>
                        <div class="tm_invoice_right tm_text_right">
                        <p class="tm_mb2"><b class="tm_primary_color">To:</b></p>
                        <p>
                            <strong class="text-inverse">Branch: {{ $courier_summary->relationtoreceiverbranch->branch_name }} </strong><br>
                            <strong class="text-inverse">Name: {{ $courier_summary->receiver_name }}</strong><br>
                            Address: {{ $courier_summary->receiver_address }}<br>
                            Phone: {{ $courier_summary->receiver_phone_number }}<br>
                        </p>
                        </div>
                    </div>
                    <div class="tm_table tm_style1">
                        <div class="">
                            <div class="tm_table_responsive">
                                <table>
                                    <thead>
                                        <tr class="tm_accent_bg">
                                            <th class="tm_width_4 tm_semi_bold tm_white_color">Description</th>
                                            <th class="tm_width_2 tm_semi_bold tm_white_color">Price</th>
                                            <th class="tm_width_1 tm_semi_bold tm_white_color">Qty</th>
                                            <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courier_details as $item)
                                        <tr>
                                            <td class="tm_width_4">{{ $item->item_description }}</td>
                                            <td class="tm_width_2">{{ $item->cost_rate }}</td>
                                            <td class="tm_width_1">{{ $item->item_quantity }}</td>
                                            <td class="tm_width_2 tm_text_right">{{ $item->total_cost_rate }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
                            <div class="tm_left_footer">
                                <p class="tm_mb2"><b class="tm_primary_color">Payment info:</b></p>
                                <p class="tm_m0">{{ $courier_summary->payment_type }}<br>Status: {{ $courier_summary->payment_status }}</p>
                            </div>
                            <div class="tm_right_footer">
                                <table class="tm_mb15">
                                    <tbody>
                                        <tr class="tm_accent_bg">
                                            <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand Total</td>
                                            <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">{{ $courier_summary->grand_total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tm_note tm_text_center tm_font_style_normal">
                            <hr class="tm_mb15">
                            <p class="tm_mb2"><b class="tm_primary_color">Special Note:</b></p>
                            <p class="tm_m0">{{ $courier_summary->special_comment }}</p>
                            <hr class="tm_mb15">
                        </div><!-- .tm_note -->
                        <div class="tm_invoice_footer tm_type1">
                            <div class="tm_left_footer"></div>
                                <div class="tm_right_footer">
                                    <div class="tm_sign tm_text_center">
                                    <p class="tm_m0 tm_primary_color"><strong>{{ env('APP_NAME') }}</strong></p>
                                    <p class="tm_m0 tm_f16 tm_primary_color">{{ $default_setting->support_phone }}</p>
                                    <p class="tm_m0 tm_f16 tm_primary_color">{{ $default_setting->support_email }}</p>
                                    <p class="tm_m0 tm_f16 tm_primary_color">{{ env('APP_URL') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tm_note tm_text_center tm_font_style_normal">
                        <hr class="tm_mb15">
                        <p class="tm_mb2"><b class="tm_primary_color">Terms & Conditions:</b></p>
                        <p class="tm_m0">All claims relating to shipping errors shall be waived by customer unless made within (7) days after delivery of goods to the address stated.</p>
                    </div><!-- .tm_note -->
                </div>
            </div>
            <div class="tm_invoice_btns tm_hide_print">
                <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
                    <span class="tm_btn_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
                    </span>
                    <span class="tm_btn_text">Print</span>
                </a>
                <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
                    <span class="tm_btn_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
                    </span>
                    <span class="tm_btn_text">Download</span>
                </button>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin') }}/invoice/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/invoice/jspdf.min.js"></script>
    <script src="{{ asset('admin') }}/invoice/html2canvas.min.js"></script>
    <script src="{{ asset('admin') }}/invoice/main.js"></script>
</body>
</html>

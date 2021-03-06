<?php
if (file_exists('./sys/init.php')) {
    require_once('./sys/init.php');
} else {
    die('Please put this file in the home directory !');
}

$updated = false;
if (!empty($_GET['updated'])) {
    $updated = true;
}
if (!empty($_POST['query'])) {
    $query = mysqli_query($mysqli, base64_decode($_POST['query']));
    if ($query) {
        $data['status'] = 200;
    } else {
        $data['status'] = 400;
        $data['error']  = mysqli_error($mysqli);
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if (!empty($_POST['update_langs'])) {
    $query = mysqli_query($mysqli, "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'bank_description', '" . htmlspecialchars_decode('<div class="bank_info">
                       <div class="dt_settings_header bg_gradient">
                           <div class="dt_settings_circle-1"></div>
                           <div class="dt_settings_circle-2"></div>
                           <div class="bank_info_innr">
                               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M11.5,1L2,6V8H21V6M16,10V17H19V10M2,22H21V19H2M10,10V17H13V10M4,10V17H7V10H4Z"></path></svg>
                               <h4 class="bank_name">Garanti Bank</h4>
                               <div class="row">
                                   <div class="col col-md-12">
                                       <div class="bank_account">
                                           <p>4796824372433055</p>
                                           <span class="help-block">Account number / IBAN</span>
                                       </div>
                                   </div>
                                   <div class="col col-md-12">
                                       <div class="bank_account_holder">
                                           <p>Antoian Kordiyal</p>
                                           <span class="help-block">Account name</span>
                                       </div>
                                   </div>
                                   <div class="col col-md-6">
                                       <div class="bank_account_code">
                                           <p>TGBATRISXXX</p>
                                           <span class="help-block">Routing code</span>
                                       </div>
                                   </div>
                                   <div class="col col-md-6">
                                       <div class="bank_account_country">
                                           <p>United States</p>
                                           <span class="help-block">Country</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>') . "')");
    $data  = array();
    $query = mysqli_query($mysqli, "SHOW COLUMNS FROM `pxp_langs`");
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = $fetched_data['Field'];
    }
    unset($data[0]);
    unset($data[1]);
    
    function PT_UpdateLangs($lang, $key, $value) {
        global $mysqli;
        $update_query         = "UPDATE pxp_langs SET `{lang}` = '{lang_text}' WHERE `lang_key` = '{lang_key}'";
        $update_replace_array = array(
            "{lang}",
            "{lang_text}",
            "{lang_key}"
        );
        return str_replace($update_replace_array, array(
            $lang,
            Generic::secure($value),
            $key
        ), $update_query);
    }
    $lang_update_queries = array();
    foreach ($data as $key => $value) {
        $value = ($value);
        if ($value == 'arabic') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', '?????????????? ?????????????? ????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users', '???????? ?????? $ {????????} ?????? ???????????? ?????????? ??????????!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users_pro', '???????? ???????????? ?????? ?????? {{} ???????? ?????? ???????????? ???????? ?????????????? ?????????? ?????????????? ???? ???? ???? ?????????? ????????????????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ref_link', '???????????? ???????????? ?????????? ???? ????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', '?????? ??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'liked_my_comment', '???????????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'liked_ur_comment', '?????????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reply_ur_comment', '???? ?????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replied_my_comment', '???? ?????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_pro', '???? ??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade_to_pro', '???????????? ????????????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade', '??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_method', '???????????? ?????????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgraded', '??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'c_payment', '???????????? ?????????? ?? ???????? ???????????????? ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', '???? ?????? ?????????? ?? ???????? ???????????????? ?????? ???????? ????????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', '?????????????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer_request', '???? ?????????? ???????? ?????????? ?? ???????? ?????????? ?????????? ???????????????? ????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', '?????? ??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', '?????????? ????????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_members', '?????????????? ??????????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'boost_post', '???????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unboost_post', '?????????? ?????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_profile', '?????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'default_profile', '?????????? ???????????? ??????????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'profile_style', '?????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_member', '?????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'boosted_posts', '?????????????????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', '?????????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_decline', '???? ?????? ???????????? ??????????????!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_pro', '?????? ???????????????? ?????? ???????????? ??????????????!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', '??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'id', '???????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'company', '????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bidding', '????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', '??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'views', '????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'status', '????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', '??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', '??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', '????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'title', '??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', '??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'location', '??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', '?????????? ?????????????? ({{PRICE}})');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_imprssion', '?????????? ?????? ???????? ({{PRICE}})');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sidebar', '???????????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', '?????????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', '?????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit', '??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url_invalid', '???????? ?????????????? ?????????? URL ????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_wallet', '???????? ?????????? ????????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_created', '???? ?????????? ???????????? ??????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'all', '????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_not_supported', '?????? ?????????????? ?????? ??????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_edited', '???? ?????????? ???????????? ??????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_not_found', '???? ?????? ???????????? ?????? ??????????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_active', '?????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_ad', '?????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirm_del_ad', '???? ?????? ?????????? ?????? ???????? ?????? ?????? ???????????????? ???? ???????? ?????????????? ???? ?????? ??????????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', '?????????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsored', '????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'featured_member', '?????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified_badge', '???????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promotion', '?????????????????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'profile_Style', '?????? ?????????? ???????????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_wait', '?????????? ??????????..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'business_account', '???????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'account_analytics', '?????????????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'today', '??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_week', '?????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_month', '?????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', '?????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw', '????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_balance', '???????????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal_email', '???????? ?????? ??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', '????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'min', '??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount_more_balance', '???? ???????? ???? ???????? ???????????? ?????????????? ???????? ???? ?????????? ????????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount_less_50', '???????????? ?????????????? ???? ???????? ???? ???????? ?????? ????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cant_request_withdrawal', '???? ?????????? ?????????? ?????? ?????????? ?????? ?????? ???????????????? ?????? / ?????? ?????????????? ??????????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdrawal_request_sent', '???? ?????????? ?????? ?????????? ?????????? ???? ??????????!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'requested_at', '?????? ????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paid', '??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pending', '?????? ????????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'declined', '??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'raise_money', '?????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_acquisition', '?????????? ?????? ?????????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_created', '???? ?????????? ?????? ?????????????? ??????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'raised_of', '?????????? ????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding', '?????????? ?????? ?????????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more', '?????????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'donate', '????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'fund_not_found', '?????? ?????????? ?????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'donated', '???????? ????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'recent_donations', '???????????????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'total_donations', '?????????? ????????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_funding', '?????????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_funding_yet', '???? ???????? ?????????? ?????????? ??????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'requested', '??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'follow_requests', '???????????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_following_you', '???????????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'accept_request', '???????? ?????? ???????????????? ?????????? ????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'accept', '????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_dont_have_requests', '?????? ???????? ???? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'business_name', '?????????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', '?????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bus_request_done', '???? ?????????? ???????? ???????? ????????????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_funding', '?????????? ?????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_edited', '???? ?????????? ?????? ?????????????? ??????????.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_now', '???????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_to', '???????? ??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'send_email', '???????? ???????? ????????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', '?????????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'shop_now', '???????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_now', '?????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'visit_now', '?????????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'book_now', '???????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'learn_more', '???????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'play_now', '???????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bet_now', '???????????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apply_here', '?????? ??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'quote_here', '?????????? ??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'order_now', '???????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'book_tickets', '?????? ??????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enroll_now', '?????????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'find_card', '???????????? ?????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_quote', '??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_tickets', '???????? ?????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'locate_dealer', '?????????? ???????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'order_online', '???????? ?????? ????????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'preorder_now', 'Preorder ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'schedule_now', '???????????? ???????????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sign_up_now', '???????? ???????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', '????????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'register_now', '?????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_target_url', '???????? ???????????????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_action', '???????? ?????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reply', '????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'how_it_works', '?????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_money', '?????????? ????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'users_register', '?????????? ????????????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_link', '?????? ????????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add', '??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_money', '?????????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_member', '?????? ??????????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stay_free', '?????? ??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enjoy_more_features', '???????????? ?????????? ???? ?????????????? ???? ???????? ???????? ????????????????!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'join_pro', '???????????? ??????!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promote_up', '?????????? ???? ?????? ??????');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_requets', '?????????? ??????????????');
        } else if ($value == 'dutch') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Mijn gelieerde partners');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users', 'Verdien tot ${amount} voor elke gebruiker die u naar ons verwijst!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users_pro', 'Verdien tot ${amount} voor elke gebruiker die naar ons verwijst en abonneert zich op een van onze pro-pakketten.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ref_link', 'Uw affiliate link is');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Delen naar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'liked_my_comment', 'vond mijn reactie leuk');
            $lang_update_queries[] = PT_UpdateLangs($value, 'liked_ur_comment', 'vond je reactie leuk');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reply_ur_comment', 'heeft op je reactie gereageerd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replied_my_comment', 'reageerde op mijn opmerking');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_pro', 'Ga Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade_to_pro', 'Upgraden naar Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade', 'Upgrade');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_method', 'Kies een betaal methode');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgraded', 'Upgraded');
            $lang_update_queries[] = PT_UpdateLangs($value, 'c_payment', 'Bevestiging van uw betaling, even geduld aub ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Betaling geweigerd. Probeer het later opnieuw.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'overschrijving');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer_request', 'Uw verzoek is succesvol verzonden, wij zullen u op de hoogte brengen zodra het is goedgekeurd.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Kredietkaart');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_members', 'Pro-leden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'boost_post', 'Boostpost');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unboost_post', 'UnBoost-bericht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_profile', 'Pro profiel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'default_profile', 'Standaard profiel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'profile_style', 'Profielstijl');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_member', 'Pro Lid');
            $lang_update_queries[] = PT_UpdateLangs($value, 'boosted_posts', 'Versterkte berichten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Portemonnee');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_decline', 'Uw bankbewijs is geweigerd!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_pro', 'Uw bank-factuur is goedgekeurd!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'Advertising');
            $lang_update_queries[] = PT_UpdateLangs($value, 'id', 'ID kaart');
            $lang_update_queries[] = PT_UpdateLangs($value, 'company', 'Bedrijf');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bidding', 'bod');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'klikken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'views', 'Keer bekeken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'status', 'staat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Actie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'cre??ren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'Doel-URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'title', 'Titel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Omschrijving');
            $lang_update_queries[] = PT_UpdateLangs($value, 'location', 'Plaats');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Betaal per klik ({{PRICE}})');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_imprssion', 'Betaal per vertoning ({{PRICE}})');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sidebar', 'sidebar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Plaatsing');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Upload foto');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit', 'voorleggen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url_invalid', 'Gebruik alstublieft een geldige URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_wallet', 'Gelieve uw portemonnee te herladen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_created', 'Uw advertentie is succesvol gemaakt.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'all', 'Allemaal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_not_supported', 'Mediabestand wordt niet ondersteund.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_edited', 'Uw advertentie is succesvol bijgewerkt.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_not_found', 'Advertentie niet gevonden.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_active', 'Niet actief');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_ad', 'Advertentie verwijderen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirm_del_ad', 'Weet je zeker dat je deze advertentie wilt verwijderen? deze actie kan niet ongedaan worden gemaakt.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Bewerk advertentie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsored', 'Sponsored');
            $lang_update_queries[] = PT_UpdateLangs($value, 'featured_member', 'Uitgelicht lid');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified_badge', 'Geverifieerde badge');
            $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promotion', 'Promotie van berichten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'profile_Style', 'Unieke profielstijl');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_wait', 'Even geduld aub..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'business_account', 'Zakelijke account');
            $lang_update_queries[] = PT_UpdateLangs($value, 'account_analytics', 'Accountanalyse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'today', 'Vandaag');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_week', 'Deze week');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_month', 'Deze maand');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Dit jaar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw', 'het terugtrekken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_balance', 'beschikbaar saldo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal_email', 'Paypal E-mail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Bedrag');
            $lang_update_queries[] = PT_UpdateLangs($value, 'min', 'min');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount_more_balance', 'Het gevraagde bedrag kan niet meer zijn dan uw werkelijke saldo.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount_less_50', 'Het gevraagde bedrag kan niet kleiner zijn dan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cant_request_withdrawal', 'U kunt geen opnameverzoek indienen totdat de vorige verzoeken zijn goedgekeurd / afgewezen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdrawal_request_sent', 'Uw opnameverzoek is met succes verzonden!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'requested_at', 'Gevraagd om');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paid', 'Betaald');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pending', 'In afwachting');
            $lang_update_queries[] = PT_UpdateLangs($value, 'declined', 'Afgewezen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'raise_money', 'Geld inzamelen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_acquisition', 'Maak een nieuw financieringsverzoek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_created', 'Financieringsaanvraag is succesvol aangemaakt.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'raised_of', 'Opgeheven van');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding', 'Maak een nieuw financieringsverzoek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more', 'Meer laden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'donate', 'schenken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'fund_not_found', 'Financieringsaanvraag niet gevonden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'donated', 'Doneer je');
            $lang_update_queries[] = PT_UpdateLangs($value, 'recent_donations', 'Recente donaties');
            $lang_update_queries[] = PT_UpdateLangs($value, 'total_donations', 'Totale donaties');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_funding', 'Financieringsverzoeken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_funding_yet', 'Er zijn nog geen financieringsverzoeken.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'requested', 'Aangevraagd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'follow_requests', 'Volg Verzoeken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_following_you', 'volgt je nu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'accept_request', 'accepteerde uw volgverzoek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'accept', 'Aanvaarden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_dont_have_requests', 'U hebt geen verzoeken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'business_name', 'Bedrijfsnaam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Telefoonnummer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bus_request_done', 'Uw aanvraag is ingediend en wordt beoordeeld.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_funding', 'Bewerkingsverzoek bewerken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_edited', 'Financieringsaanvraag is succesvol bijgewerkt.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_now', 'Bel nu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_to', 'Ga naar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'send_email', 'Verzend e-mail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Lees verder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'shop_now', 'Winkel nu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_now', 'Kijk nu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'visit_now', 'Bezoek nu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'book_now', 'Boek nu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'learn_more', 'Kom meer te weten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'play_now', 'Nu afspelen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bet_now', 'Wed nu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apply_here', 'Voeg hier toe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'quote_here', 'Quote hier');
            $lang_update_queries[] = PT_UpdateLangs($value, 'order_now', 'Bestel nu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'book_tickets', 'Boek tickets');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enroll_now', 'Schrijf nu in');
            $lang_update_queries[] = PT_UpdateLangs($value, 'find_card', 'Zoek een kaart');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_quote', 'Vraag een offerte aan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_tickets', 'Krijg kaartjes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'locate_dealer', 'Zoek een dealer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'order_online', 'Bestel online');
            $lang_update_queries[] = PT_UpdateLangs($value, 'preorder_now', 'Bestel nu vooraf');
            $lang_update_queries[] = PT_UpdateLangs($value, 'schedule_now', 'Plan nu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sign_up_now', 'Meld je nu aan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'abonneren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'register_now', 'Registreer nu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_target_url', 'Call naar doel-URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_action', 'Oproep tot actie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reply', 'Antwoord');
            $lang_update_queries[] = PT_UpdateLangs($value, 'how_it_works', 'Hoe het werkt');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_money', 'Geld verdienen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'users_register', 'Gebruikers registreren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_link', 'Deel link');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add', 'Toevoegen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_money', 'Voeg geld toe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_member', 'gratis lid');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stay_free', 'Blijf vrij');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enjoy_more_features', 'Geniet van meer functies zonder pro-pakket!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'join_pro', 'Word lid van Pro!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promote_up', 'Promoot tot');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_requets', 'Financieringsverzoeken');
        } else if ($value == 'french') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Mes affili??s');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users', 'Gagnez jusqu\'?? ${amount} pour chaque utilisateur que vous nous r??f??rez!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users_pro', 'Gagnez jusqu\'?? ${amount} pour chaque utilisateur que vous nous r??f??rez et vous vous abonner ?? l\'un de nos forfaits professionnels.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ref_link', 'Votre lien d\'affili?? est');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Partager ??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'liked_my_comment', 'aim?? mon commentaire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'liked_ur_comment', 'aim?? ton commentaire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reply_ur_comment', 'r??pondu ?? votre commentaire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replied_my_comment', 'a r??pondu ?? mon commentaire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_pro', 'Go Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade_to_pro', 'Passer ?? Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade', 'Am??liorer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_method', 'Choisissez une m??thode de paiement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgraded', 'Mis ?? niveau');
            $lang_update_queries[] = PT_UpdateLangs($value, 'c_payment', 'Confirmant votre paiement, veuillez patienter ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Paiement refus??, veuillez r??essayer plus tard.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'virement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer_request', 'Votre demande a ??t?? envoy??e avec succ??s, nous vous en informerons une fois approuv??e.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'Pay Pal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Carte de cr??dit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_members', 'Membres Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'boost_post', 'Boost Post');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unboost_post', 'UnBoost Post');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_profile', 'Profil pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'default_profile', 'Profil par d??faut');
            $lang_update_queries[] = PT_UpdateLangs($value, 'profile_style', 'Style de profil');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_member', 'Membre Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'boosted_posts', 'Messages boost??s');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Portefeuille');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_decline', 'Votre ticket de banque a ??t?? refus??!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_pro', 'Votre re??u de banque a ??t?? approuv??!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'La publicit??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'id', 'ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'company', 'Entreprise');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bidding', 'Ench??re');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Clics');
            $lang_update_queries[] = PT_UpdateLangs($value, 'views', 'Des vues');
            $lang_update_queries[] = PT_UpdateLangs($value, 'status', 'Statut');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'action');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Cr??er');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'Cible URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'title', 'Titre');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'La description');
            $lang_update_queries[] = PT_UpdateLangs($value, 'location', 'Emplacement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Pay Per Click ({{PRIX}})');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_imprssion', 'Paiement par impression ({{PRICE}})');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sidebar', 'Barre lat??rale');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Placement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Envoyer la photo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit', 'Soumettre');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url_invalid', 'Veuillez utiliser une URL valide.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_wallet', 'S\'il vous pla??t recharger votre portefeuille.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_created', 'Votre annonce a ??t?? cr????e avec succ??s.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'all', 'Tout');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_not_supported', 'Le fichier multim??dia n\'est pas pris en charge.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_edited', 'Votre annonce a ??t?? mise ?? jour avec succ??s.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_not_found', 'Annonce non trouv??e.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_active', 'Pas actif');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_ad', 'Supprimer une annonce');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirm_del_ad', '??tes-vous s??r de vouloir supprimer cette annonce? cette action ne peut pas ??tre annul??e.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Modifier une annonce');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsored', 'Sponsoris??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'featured_member', 'Membre vedette');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified_badge', 'Badge v??rifi??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promotion', 'Postes en promotion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'profile_Style', 'Style de profil unique');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_wait', 'S\'il vous pla??t, attendez..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'business_account', 'Compte commercial');
            $lang_update_queries[] = PT_UpdateLangs($value, 'account_analytics', 'Analyse de compte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'today', 'Aujourd\'hui');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_week', 'Cette semaine');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_month', 'Ce mois-ci');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Cette ann??e');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw', 'Retrait');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_balance', 'Solde disponible');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal_email', 'Email Paypal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Montant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'min', 'Min');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount_more_balance', 'Le montant demand?? ne peut ??tre sup??rieur ?? votre solde r??el.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount_less_50', 'Le montant demand?? ne peut ??tre inf??rieur ??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cant_request_withdrawal', 'Vous ne pouvez pas soumettre de demande de retrait avant que les demandes pr??c??dentes aient ??t?? approuv??es / rejet??es.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdrawal_request_sent', 'Votre demande de retrait a ??t?? envoy??e avec succ??s!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'requested_at', 'Demand?? ??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paid', 'Pay??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pending', 'en attendant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'declined', 'Diminu??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'raise_money', 'Amasser de l\'argent');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_acquisition', 'Cr??er une nouvelle demande de financement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_created', 'La demande de financement a ??t?? cr????e avec succ??s.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'raised_of', '??lev?? de');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding', 'Cr??er une nouvelle demande de financement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more', 'Charger plus');
            $lang_update_queries[] = PT_UpdateLangs($value, 'donate', 'Faire un don');
            $lang_update_queries[] = PT_UpdateLangs($value, 'fund_not_found', 'Demande de financement non trouv??e');
            $lang_update_queries[] = PT_UpdateLangs($value, 'donated', 'Vous faire un don');
            $lang_update_queries[] = PT_UpdateLangs($value, 'recent_donations', 'Dons r??cents');
            $lang_update_queries[] = PT_UpdateLangs($value, 'total_donations', 'Total des dons');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_funding', 'Demandes de financement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_funding_yet', 'Il n\'y a pas encore de demande de financement.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'requested', 'Demand??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'follow_requests', 'Suivre les demandes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_following_you', 'vous suit maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'accept_request', 'accept?? votre demande de suivi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'accept', 'Acceptez');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_dont_have_requests', 'Vous n\'avez aucune demande');
            $lang_update_queries[] = PT_UpdateLangs($value, 'business_name', 'Nom de l\'entreprise');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Num??ro de t??l??phone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bus_request_done', 'Votre demande a ??t?? soumise et en cours de r??vision.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_funding', 'Modifier la demande de financement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_edited', 'La demande de financement a ??t?? mise ?? jour avec succ??s.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_now', 'Appelle maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_to', 'Aller ??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'send_email', 'Envoyer un email');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Lire la suite');
            $lang_update_queries[] = PT_UpdateLangs($value, 'shop_now', 'Achetez maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_now', 'Voir maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'visit_now', 'Visitez maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'book_now', 'Reserve maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'learn_more', 'Apprendre encore plus');
            $lang_update_queries[] = PT_UpdateLangs($value, 'play_now', 'Joue maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bet_now', 'Parier maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apply_here', 'Appliquer ici');
            $lang_update_queries[] = PT_UpdateLangs($value, 'quote_here', 'Citez ici');
            $lang_update_queries[] = PT_UpdateLangs($value, 'order_now', 'Commandez maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'book_tickets', 'R??server des billets');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enroll_now', 'Inscrivez-vous maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'find_card', 'Trouver une carte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_quote', 'Obtenir un devis');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_tickets', 'Procurez-vous des billets');
            $lang_update_queries[] = PT_UpdateLangs($value, 'locate_dealer', 'Localiser un revendeur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'order_online', 'Commander en ligne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'preorder_now', 'Pr?? commandez maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'schedule_now', 'Horaire maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sign_up_now', 'S\'inscrire maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Souscrire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'register_now', 'inscrire maintenant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_target_url', 'Appeler pour cibler l\'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_action', 'Appel ?? l\'action');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reply', 'R??pondre');
            $lang_update_queries[] = PT_UpdateLangs($value, 'how_it_works', 'Comment ??a marche');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_money', 'Gagner de l\'argent');
            $lang_update_queries[] = PT_UpdateLangs($value, 'users_register', 'Registre des utilisateurs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_link', 'Lien de partage');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add', 'Ajouter');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_money', 'Ajouter de l\'argent');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_member', 'Membre gratuit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stay_free', 'Reste libre');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enjoy_more_features', 'Profitez de plus de fonctionnalit??s avec le forfait pro!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'join_pro', 'Rejoignez Pro!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promote_up', 'Promouvoir jusqu\'??');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_requets', 'Demandes de financement');
        } else if ($value == 'german') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Meine Partner');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users', 'Verdienen Sie bis zu ${amount} f??r jeden Nutzer, den Sie uns empfehlen!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users_pro', 'Verdienen Sie bis zu ${amount} f??r jeden Nutzer, den Sie uns nennen, und abonnieren Sie eines unserer Profi-Pakete.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'your_ref_link', 'Ihr Affiliate-Link lautet');
    $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Teilen mit');
    $lang_update_queries[] = PT_UpdateLangs($value, 'liked_my_comment', 'mochte mein Kommentar');
    $lang_update_queries[] = PT_UpdateLangs($value, 'liked_ur_comment', 'mochte dein Kommentar');
    $lang_update_queries[] = PT_UpdateLangs($value, 'reply_ur_comment', 'hat auf deinen Kommentar geantwortet');
    $lang_update_queries[] = PT_UpdateLangs($value, 'replied_my_comment', 'antwortete auf meinen Kommentar');
    $lang_update_queries[] = PT_UpdateLangs($value, 'go_pro', 'Pro gehen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade_to_pro', 'Upgrade auf Pro');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade', 'Aktualisierung');
    $lang_update_queries[] = PT_UpdateLangs($value, 'choose_method', 'W??hlen Sie eine Bezahlungsart');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgraded', 'Aufger??stet');
    $lang_update_queries[] = PT_UpdateLangs($value, 'c_payment', 'Best??tigung Ihrer Zahlung, bitte warten Sie ..');
    $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Zahlung abgelehnt, bitte versuchen Sie es sp??ter erneut.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Bank??berweisung');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer_request', 'Ihre Anfrage wurde erfolgreich gesendet, wir werden Sie benachrichtigen, sobald sie genehmigt wurde.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
    $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Kreditkarte');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pro_members', 'Pro Mitglieder');
    $lang_update_queries[] = PT_UpdateLangs($value, 'boost_post', 'Boost Post');
    $lang_update_queries[] = PT_UpdateLangs($value, 'unboost_post', 'UnBoost Post');
    $lang_update_queries[] = PT_UpdateLangs($value, 'new_profile', 'Pro-Profil');
    $lang_update_queries[] = PT_UpdateLangs($value, 'default_profile', 'Standard Profil');
    $lang_update_queries[] = PT_UpdateLangs($value, 'profile_style', 'Profilstil');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pro_member', 'Pro-Mitglied');
    $lang_update_queries[] = PT_UpdateLangs($value, 'boosted_posts', 'Boosted Posts');
    $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Brieftasche');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_decline', 'Ihr Bankbeleg wurde abgelehnt!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_pro', 'Ihre Bankquittung wurde genehmigt!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'Werbung');
    $lang_update_queries[] = PT_UpdateLangs($value, 'id', 'ICH W??RDE');
    $lang_update_queries[] = PT_UpdateLangs($value, 'company', 'Unternehmen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bidding', 'Bieten');
    $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Klicks');
    $lang_update_queries[] = PT_UpdateLangs($value, 'views', 'Ansichten');
    $lang_update_queries[] = PT_UpdateLangs($value, 'status', 'Status');
    $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Aktion');
    $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Erstellen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'Ziel-URL');
    $lang_update_queries[] = PT_UpdateLangs($value, 'title', 'Titel');
    $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Beschreibung');
    $lang_update_queries[] = PT_UpdateLangs($value, 'location', 'Ort');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Pay Per Click ({{PRICE}})');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_imprssion', 'Pay Per Impression ({{PRICE}})');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sidebar', 'Seitenleiste');
    $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Platzierung');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Foto hochladen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'submit', 'einreichen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'url_invalid', 'Bitte verwenden Sie eine g??ltige URL.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'top_wallet', 'Bitte f??llen Sie Ihre Geldb??rse auf.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_created', 'Ihre Anzeige wurde erfolgreich erstellt.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'all', 'Alles');
    $lang_update_queries[] = PT_UpdateLangs($value, 'media_not_supported', 'Mediendatei wird nicht unterst??tzt.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_edited', 'Ihre Anzeige wurde erfolgreich aktualisiert.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_not_found', 'Anzeige nicht gefunden');
    $lang_update_queries[] = PT_UpdateLangs($value, 'not_active', 'Nicht aktiv');
    $lang_update_queries[] = PT_UpdateLangs($value, 'delete_ad', 'Anzeige l??schen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'confirm_del_ad', 'M??chten Sie diese Anzeige wirklich l??schen? Diese Aktion kann nicht r??ckg??ngig gemacht werden.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Anzeige bearbeiten');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sponsored', 'Gesponsert');
    $lang_update_queries[] = PT_UpdateLangs($value, 'featured_member', 'Vorgestelltes Mitglied');
    $lang_update_queries[] = PT_UpdateLangs($value, 'verified_badge', 'Verifizierter Ausweis');
    $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promotion', 'Beitr??ge Promotion');
    $lang_update_queries[] = PT_UpdateLangs($value, 'profile_Style', 'Einzigartiger Profilstil');
    $lang_update_queries[] = PT_UpdateLangs($value, 'please_wait', 'Warten Sie mal..');
    $lang_update_queries[] = PT_UpdateLangs($value, 'business_account', 'Gesch??ftskonto');
    $lang_update_queries[] = PT_UpdateLangs($value, 'account_analytics', 'Kontoanalyse');
    $lang_update_queries[] = PT_UpdateLangs($value, 'today', 'Heute');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_week', 'Diese Woche');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_month', 'Diesen Monat');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Dieses Jahr');
    $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw', 'R??ckzug');
    $lang_update_queries[] = PT_UpdateLangs($value, 'available_balance', 'Verf??gbares Guthaben');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paypal_email', 'Paypal Email');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Menge');
    $lang_update_queries[] = PT_UpdateLangs($value, 'min', 'Mindest');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount_more_balance', 'Der angeforderte Betrag kann nicht mehr als Ihr tats??chlicher Kontostand betragen.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount_less_50', 'Der angeforderte Betrag kann nicht geringer sein als');
    $lang_update_queries[] = PT_UpdateLangs($value, 'cant_request_withdrawal', 'Sie k??nnen eine Auszahlungsanforderung erst absenden, wenn die vorherigen Anforderungen genehmigt / abgelehnt wurden.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'withdrawal_request_sent', 'Ihre Auszahlungsanfrage wurde erfolgreich gesendet!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'requested_at', 'Angefordert bei');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paid', 'Bezahlt');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pending', 'steht aus');
    $lang_update_queries[] = PT_UpdateLangs($value, 'declined', 'Abgelehnt');
    $lang_update_queries[] = PT_UpdateLangs($value, 'raise_money', 'Geld sammeln');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_acquisition', 'Neue Finanzierungsanfrage erstellen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_created', 'Finanzierungsanfrage wurde erfolgreich erstellt.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'raised_of', 'Angehoben von');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding', 'Neue Finanzierungsanfrage erstellen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'load_more', 'Mehr laden');
    $lang_update_queries[] = PT_UpdateLangs($value, 'donate', 'Spenden');
    $lang_update_queries[] = PT_UpdateLangs($value, 'fund_not_found', 'Finanzierungsanfrage nicht gefunden');
    $lang_update_queries[] = PT_UpdateLangs($value, 'donated', 'Spende dich');
    $lang_update_queries[] = PT_UpdateLangs($value, 'recent_donations', 'Letzte Spenden');
    $lang_update_queries[] = PT_UpdateLangs($value, 'total_donations', 'Spenden insgesamt');
    $lang_update_queries[] = PT_UpdateLangs($value, 'user_funding', 'Finanzierungsantr??ge');
    $lang_update_queries[] = PT_UpdateLangs($value, 'no_funding_yet', 'Es gibt noch keine Finanzierungsantr??ge.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'requested', 'Beantragt');
    $lang_update_queries[] = PT_UpdateLangs($value, 'follow_requests', 'Anfragen folgen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'is_following_you', 'folgt dir jetzt');
    $lang_update_queries[] = PT_UpdateLangs($value, 'accept_request', 'Ihre Anfrage wurde akzeptiert');
    $lang_update_queries[] = PT_UpdateLangs($value, 'accept', 'Akzeptieren');
    $lang_update_queries[] = PT_UpdateLangs($value, 'u_dont_have_requests', 'Sie haben keine Anfragen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'business_name', 'Gesch??ftsname');
    $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Telefonnummer');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bus_request_done', 'Ihre Anfrage wurde ??bermittelt und wird gepr??ft.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'edit_funding', 'Finanzierungsanfrage bearbeiten');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_edited', 'Finanzierungsanfrage wurde erfolgreich aktualisiert.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_now', 'Jetzt anrufen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'go_to', 'Gehe zu');
    $lang_update_queries[] = PT_UpdateLangs($value, 'send_email', 'E-Mail senden');
    $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Weiterlesen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'shop_now', 'Jetzt einkaufen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'view_now', 'Jetzt ansehen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'visit_now', 'Jetzt besuchen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'book_now', 'Buchen Sie jetzt');
    $lang_update_queries[] = PT_UpdateLangs($value, 'learn_more', 'Mehr erfahren');
    $lang_update_queries[] = PT_UpdateLangs($value, 'play_now', 'Jetzt spielen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bet_now', 'Wetten Sie jetzt');
    $lang_update_queries[] = PT_UpdateLangs($value, 'apply_here', 'Hier bewerben');
    $lang_update_queries[] = PT_UpdateLangs($value, 'quote_here', 'Hier zitieren');
    $lang_update_queries[] = PT_UpdateLangs($value, 'order_now', 'Jetzt bestellen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'book_tickets', 'Tickets buchen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'enroll_now', 'Jetzt anmelden');
    $lang_update_queries[] = PT_UpdateLangs($value, 'find_card', 'Eine Karte finden');
    $lang_update_queries[] = PT_UpdateLangs($value, 'get_quote', 'Ein Angebot bekommen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'get_tickets', 'Tickets bekommen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'locate_dealer', 'Finden Sie einen H??ndler');
    $lang_update_queries[] = PT_UpdateLangs($value, 'order_online', 'Online bestellen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'preorder_now', 'Jetzt vorbestellen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'schedule_now', 'Jetzt planen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sign_up_now', 'Jetzt registrieren');
    $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Abonnieren');
    $lang_update_queries[] = PT_UpdateLangs($value, 'register_now', 'Jetzt registrieren');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_target_url', 'Rufen Sie die Ziel-URL auf');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_action', 'Aufruf zum Handeln');
    $lang_update_queries[] = PT_UpdateLangs($value, 'reply', 'Antworten');
    $lang_update_queries[] = PT_UpdateLangs($value, 'how_it_works', 'Wie es funktioniert');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_money', 'Geld verdienen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'users_register', 'Benutzer registrieren');
    $lang_update_queries[] = PT_UpdateLangs($value, 'share_link', 'Einen Link teilen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'add', 'Hinzuf??gen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'add_money', 'Geld hinzuf??gen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'free_member', 'Freies Mitglied');
    $lang_update_queries[] = PT_UpdateLangs($value, 'stay_free', 'Bleibe frei');
    $lang_update_queries[] = PT_UpdateLangs($value, 'enjoy_more_features', 'Genie??en Sie weitere Funktionen mit unserem Pro-Paket!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'join_pro', 'Pro beitreten');
    $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promote_up', 'Bis zu f??rdern');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_requets', 'Finanzierungsantr??ge');
        } else if ($value == 'russian') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', '?????? ??????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users', '?????????????????????????? ???? ${amount} ???? ?????????????? ????????????????????????, ???????????????? ???? ?????????????????????? ?? ??????!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users_pro', '?????????????????????? ???? ${amount} ???? ?????????????? ????????????????????????, ???????????????? ???? ????????????????????, ?? ?????????????????????? ???? ?????????? ???? ?????????? ???????????????????????????????? ??????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'your_ref_link', '???????? ?????????????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', '???????????????????? ??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'liked_my_comment', '???????????????????? ?????? ??????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'liked_ur_comment', '???????????????????? ???????? ??????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'reply_ur_comment', '?????????????? ???? ?????? ??????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'replied_my_comment', '?????????????? ???? ?????? ??????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'go_pro', 'Go Pro');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade_to_pro', '???????????????? ???? Pro');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade', '????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'choose_method', '???????????????? ???????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgraded', '??????????????????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'c_payment', '?????????????????????????? ????????????, ????????????????????, ?????????????????? ..');
    $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', '???????????? ????????????????, ?????????????????? ?????????????? ??????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', '???????????????????? ??????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer_request', '?????? ???????????? ?????? ?????????????? ??????????????????, ???? ?????????????? ??????, ?????? ???????????? ???? ?????????? ??????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
    $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', '?????????????????? ??????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pro_members', '?????? ??????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'boost_post', 'Boost Post');
    $lang_update_queries[] = PT_UpdateLangs($value, 'unboost_post', 'UnBoost Post');
    $lang_update_queries[] = PT_UpdateLangs($value, 'new_profile', '?????? ??????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'default_profile', '?????????????? ???? ??????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'profile_style', '?????????? ??????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pro_member', 'Pro Member');
    $lang_update_queries[] = PT_UpdateLangs($value, 'boosted_posts', '?????????????????? ??????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', '????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_decline', '???????? ???????????????????? ?????????????????? ???????? ??????????????????!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_pro', '???????? ???????????????????? ?????????????????? ???????? ????????????????????????!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', '??????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'id', '?? ????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'company', '????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bidding', '??????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', '????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'views', '??????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'status', '????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'action', '????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'create', '????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'url', '?????????????? URL');
    $lang_update_queries[] = PT_UpdateLangs($value, 'title', '????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'description', '????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'location', '?????????? ????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', '???????????? ???? ???????? ({{PRICE}})');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_imprssion', '???????????? ???? ?????????? ({{PRICE}})');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sidebar', '?????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'placement', '????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', '?????????????????? ????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'submit', '??????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'url_invalid', '????????????????????, ?????????????????????? ???????????????????????????? URL.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'top_wallet', '????????????????????, ?????????????????? ???????? ??????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_created', '???????? ???????????????????? ???????? ?????????????? ??????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'all', '??????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'media_not_supported', '??????????-???????? ???? ????????????????????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_edited', '???????? ???????????????????? ???????? ?????????????? ??????????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_not_found', '???????????????????? ???? ??????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'not_active', '???? ??????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'delete_ad', '?????????????? ????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'confirm_del_ad', '???? ??????????????, ?????? ???????????? ?????????????? ?????? ??????????????? ?????? ???????????????? ???? ?????????? ???????? ????????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', '???????????????? ????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sponsored', '??????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'featured_member', '?????????????????? ????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'verified_badge', '?????????????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promotion', '?????????????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'profile_Style', '???????????????????? ?????????? ??????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'please_wait', '?????????????????? ????????????????????..');
    $lang_update_queries[] = PT_UpdateLangs($value, 'business_account', '???????????? ??????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'account_analytics', '?????????????????? ????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'today', '??????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_week', '???? ???????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_month', '???????? ??????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', '?? ???????? ????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw', '??????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'available_balance', '?????????????????? ????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paypal_email', 'PayPal E-mail');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount', '????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'min', 'Min');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount_more_balance', '?????????????????????????? ?????????? ???? ?????????? ?????????????????? ?????? ?????????????????????? ????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount_less_50', '?????????????????????????? ?????????? ???? ?????????? ???????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'cant_request_withdrawal', '???? ???? ???????????? ???????????? ???????????? ???? ???????????? ??????????????, ???????? ???????????????????? ?????????????? ???? ???????? ???????????????? / ??????????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'withdrawal_request_sent', '?????? ???????????? ???? ?????????? ?????????????? ?????? ?????????????? ??????????????????!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'requested_at', '?????????????????? ??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paid', '????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pending', '?? ????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'declined', '??????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'raise_money', '???????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_acquisition', '?????????????? ?????????? ???????????? ???? ????????????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_created', '???????????? ???? ???????????????????????????? ?????? ?????????????? ????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'raised_of', '???????????? ????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding', '?????????????? ?????????? ???????????? ???? ????????????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'load_more', '?????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'donate', '????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'fund_not_found', '???????????? ???? ???????????????????????????? ???? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'donated', '???????????????? ????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'recent_donations', '???????????????? ??????????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'total_donations', '?????????? ??????????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'user_funding', '?????????????? ???? ????????????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'no_funding_yet', '???????? ?????? ???????????????? ???? ????????????????????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'requested', '??????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'follow_requests', '???????????????? ????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'is_following_you', '???????????? ???? ?????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'accept_request', '???????????? ?????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'accept', '??????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'u_dont_have_requests', '?? ?????? ?????? ????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'business_name', '???????????????????????? ??????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', '?????????? ????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bus_request_done', '?????? ???????????? ?????? ?????????????????? ?? ?????????????????? ???? ????????????????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'edit_funding', '???????????????? ???????????? ???? ????????????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_edited', '???????????? ???? ???????????????????????????? ?????? ?????????????? ????????????????.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_now', '?????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'go_to', '???????? ??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'send_email', '?????????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', '???????????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'shop_now', '?????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'view_now', '???????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'visit_now', '???????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'book_now', '???????????????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'learn_more', '?????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'play_now', '???????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bet_now', '???????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'apply_here', '???????????? ???????????? ??????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'quote_here', '???????????????????? ??????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'order_now', '???????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'book_tickets', '?????????????????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'enroll_now', '?????????????????????????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'find_card', '?????????? ??????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'get_quote', '???????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'get_tickets', '???????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'locate_dealer', '?????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'order_online', '???????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'preorder_now', '?????????????????????????????? ?????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'schedule_now', '???????????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sign_up_now', '?????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', '????????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'register_now', '????????????????????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_target_url', '?????????????? ???? ?????????????? URL');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_action', '???????????? ?? ????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'reply', '????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'how_it_works', '?????? ?????? ????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_money', '?????????????????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'users_register', '?????????????????????? ??????????????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'share_link', '???????????????????? ??????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'add', '??????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'add_money', '???????????????? ????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'free_member', '???????????????????? ????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'stay_free', '?????????????????? ??????????????????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'enjoy_more_features', '?????????????????????????? ?????????????? ?????????????????????? ?????????????? ?????? ???????????? ?????????????????????????????????? ????????????!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'join_pro', '?????????????????????????????? ?? Pro!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promote_up', '???????????????????? ????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_requets', '?????????????? ???? ????????????????????????????');
        } else if ($value == 'spanish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Mis afiliados');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users', '??Gane hasta ${amount} por cada usuario que nos refiera!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users_pro', 'Gane hasta ${amount} por cada usuario que nos refiera y se suscribir?? a cualquiera de nuestros paquetes profesionales.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'your_ref_link', 'Su enlace de afiliado es');
    $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Compartir a');
    $lang_update_queries[] = PT_UpdateLangs($value, 'liked_my_comment', 'me gust?? mi comentario');
    $lang_update_queries[] = PT_UpdateLangs($value, 'liked_ur_comment', 'me gust?? tu comentario');
    $lang_update_queries[] = PT_UpdateLangs($value, 'reply_ur_comment', 'respondi?? a tu comentario');
    $lang_update_queries[] = PT_UpdateLangs($value, 'replied_my_comment', 'respondi?? a mi comentario');
    $lang_update_queries[] = PT_UpdateLangs($value, 'go_pro', 'Go Pro');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade_to_pro', 'Actualizar a Pro');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade', 'Mejorar');
    $lang_update_queries[] = PT_UpdateLangs($value, 'choose_method', 'Elija un m??todo de pago');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgraded', 'Actualizado');
    $lang_update_queries[] = PT_UpdateLangs($value, 'c_payment', 'Confirmando su pago, por favor espere ..');
    $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Pago rechazado, int??ntalo de nuevo m??s tarde.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'transferencia bancaria');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer_request', 'Su solicitud ha sido enviada exitosamente, le notificaremos una vez que sea aprobada.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
    $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Tarjeta de cr??dito');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pro_members', 'Miembros Pro');
    $lang_update_queries[] = PT_UpdateLangs($value, 'boost_post', 'Boost Post');
    $lang_update_queries[] = PT_UpdateLangs($value, 'unboost_post', 'Publicar unBoost');
    $lang_update_queries[] = PT_UpdateLangs($value, 'new_profile', 'Pro Profile');
    $lang_update_queries[] = PT_UpdateLangs($value, 'default_profile', 'Perfil por defecto');
    $lang_update_queries[] = PT_UpdateLangs($value, 'profile_style', 'Estilo de perfil');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pro_member', 'Miembro Pro');
    $lang_update_queries[] = PT_UpdateLangs($value, 'boosted_posts', 'Publicaciones mejoradas');
    $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Billetera');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_decline', 'Su recibo bancario ha sido rechazado!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_pro', 'Su recibo bancario ha sido aprobado!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'Publicidad');
    $lang_update_queries[] = PT_UpdateLangs($value, 'id', 'CARN?? DE IDENTIDAD');
    $lang_update_queries[] = PT_UpdateLangs($value, 'company', 'Empresa');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bidding', 'Ofertas');
    $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Clics');
    $lang_update_queries[] = PT_UpdateLangs($value, 'views', 'Puntos de vista');
    $lang_update_queries[] = PT_UpdateLangs($value, 'status', 'Estado');
    $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Acci??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Crear');
    $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL de destino');
    $lang_update_queries[] = PT_UpdateLangs($value, 'title', 'T??tulo');
    $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Descripci??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'location', 'Ubicaci??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Pago por clic ({{PRICE}})');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_imprssion', 'Pago por impresi??n ({{PRICE}})');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sidebar', 'Barra lateral');
    $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Colocaci??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Subir foto');
    $lang_update_queries[] = PT_UpdateLangs($value, 'submit', 'Enviar');
    $lang_update_queries[] = PT_UpdateLangs($value, 'url_invalid', 'Por favor, use una URL v??lida.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'top_wallet', 'Por favor recargue su billetera.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_created', 'Su anuncio ha sido creado con ??xito.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'all', 'Todos');
    $lang_update_queries[] = PT_UpdateLangs($value, 'media_not_supported', 'El archivo multimedia no es compatible.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_edited', 'Su anuncio ha sido actualizado con ??xito.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_not_found', 'Anuncio no encontrado.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'not_active', 'No activo');
    $lang_update_queries[] = PT_UpdateLangs($value, 'delete_ad', 'Eliminar anuncio');
    $lang_update_queries[] = PT_UpdateLangs($value, 'confirm_del_ad', '??Est??s seguro de que quieres eliminar esta publicidad? Esta acci??n no se puede deshacer.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Editar Anuncio');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sponsored', 'Patrocinado');
    $lang_update_queries[] = PT_UpdateLangs($value, 'featured_member', 'Miembro destacado');
    $lang_update_queries[] = PT_UpdateLangs($value, 'verified_badge', 'Insignia verificada');
    $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promotion', 'Promocion de publicaciones');
    $lang_update_queries[] = PT_UpdateLangs($value, 'profile_Style', 'Estilo de perfil ??nico');
    $lang_update_queries[] = PT_UpdateLangs($value, 'please_wait', 'Por favor espera..');
    $lang_update_queries[] = PT_UpdateLangs($value, 'business_account', 'Cuenta de negocios');
    $lang_update_queries[] = PT_UpdateLangs($value, 'account_analytics', 'An??lisis de cuentas');
    $lang_update_queries[] = PT_UpdateLangs($value, 'today', 'Hoy');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_week', 'Esta semana');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_month', 'Este mes');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Este a??o');
    $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw', 'Retirada');
    $lang_update_queries[] = PT_UpdateLangs($value, 'available_balance', 'Saldo disponible');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paypal_email', 'E-mail de Paypal');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Cantidad');
    $lang_update_queries[] = PT_UpdateLangs($value, 'min', 'Min');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount_more_balance', 'La cantidad solicitada no puede ser m??s que su saldo real.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount_less_50', 'La cantidad solicitada no puede ser inferior a');
    $lang_update_queries[] = PT_UpdateLangs($value, 'cant_request_withdrawal', 'No puede enviar una solicitud de retiro hasta que las solicitudes anteriores hayan sido aprobadas / rechazadas.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'withdrawal_request_sent', 'Su solicitud de retiro ha sido enviada con ??xito!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'requested_at', 'Solicitado en');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paid', 'Pagado');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pending', 'Pendiente');
    $lang_update_queries[] = PT_UpdateLangs($value, 'declined', 'Rechazado');
    $lang_update_queries[] = PT_UpdateLangs($value, 'raise_money', 'Recaudar dinero');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_acquisition', 'Crear nueva solicitud de financiaci??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_created', 'Solicitud de financiaci??n ha sido creado con ??xito.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'raised_of', 'Planteado de');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding', 'Crear nueva solicitud de financiaci??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'load_more', 'Carga m??s');
    $lang_update_queries[] = PT_UpdateLangs($value, 'donate', 'Donar');
    $lang_update_queries[] = PT_UpdateLangs($value, 'fund_not_found', 'Solicitud de financiaci??n no encontrada');
    $lang_update_queries[] = PT_UpdateLangs($value, 'donated', 'Donate');
    $lang_update_queries[] = PT_UpdateLangs($value, 'recent_donations', 'Donaciones recientes');
    $lang_update_queries[] = PT_UpdateLangs($value, 'total_donations', 'Donaciones totales');
    $lang_update_queries[] = PT_UpdateLangs($value, 'user_funding', 'Solicitudes de financiaci??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'no_funding_yet', 'No hay solicitudes de financiaci??n todav??a.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'requested', 'Pedido');
    $lang_update_queries[] = PT_UpdateLangs($value, 'follow_requests', 'Seguir Solicitudes');
    $lang_update_queries[] = PT_UpdateLangs($value, 'is_following_you', 'te esta siguiendo ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'accept_request', 'acept?? su solicitud de seguimiento');
    $lang_update_queries[] = PT_UpdateLangs($value, 'accept', 'Aceptar');
    $lang_update_queries[] = PT_UpdateLangs($value, 'u_dont_have_requests', 'No tienes ninguna petici??n.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'business_name', 'Nombre del Negocio');
    $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'N??mero de tel??fono');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bus_request_done', 'Su solicitud ha sido enviada y en revisi??n.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'edit_funding', 'Editar solicitud de financiaci??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_edited', 'Solicitud de financiaci??n se ha actualizado con ??xito.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_now', 'Llama ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'go_to', 'Ir');
    $lang_update_queries[] = PT_UpdateLangs($value, 'send_email', 'Enviar correo electr??nico');
    $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Lee mas');
    $lang_update_queries[] = PT_UpdateLangs($value, 'shop_now', 'Compra ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'view_now', 'Ver ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'visit_now', 'Visitar ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'book_now', 'Reservar ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'learn_more', 'Aprende m??s');
    $lang_update_queries[] = PT_UpdateLangs($value, 'play_now', 'Reproducir ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bet_now', 'Apuesta ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'apply_here', 'Aplicar aqu??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'quote_here', 'Cita aqui');
    $lang_update_queries[] = PT_UpdateLangs($value, 'order_now', 'Ordenar ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'book_tickets', 'Reservar pasajes');
    $lang_update_queries[] = PT_UpdateLangs($value, 'enroll_now', 'Enl??state ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'find_card', 'Encontrar una tarjeta');
    $lang_update_queries[] = PT_UpdateLangs($value, 'get_quote', 'Consigue una cotizaci??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'get_tickets', 'Conseguir entradas');
    $lang_update_queries[] = PT_UpdateLangs($value, 'locate_dealer', 'Encuentra un distribuidor');
    $lang_update_queries[] = PT_UpdateLangs($value, 'order_online', 'Comprar online');
    $lang_update_queries[] = PT_UpdateLangs($value, 'preorder_now', 'Preordenar ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'schedule_now', 'Programar ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sign_up_now', 'Reg??strate ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Suscribir');
    $lang_update_queries[] = PT_UpdateLangs($value, 'register_now', 'Reg??strate ahora');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_target_url', 'Llamar a la URL de destino');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_action', 'Llamada a la acci??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'reply', 'Respuesta');
    $lang_update_queries[] = PT_UpdateLangs($value, 'how_it_works', 'C??mo funciona');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_money', 'Ganar dinero');
    $lang_update_queries[] = PT_UpdateLangs($value, 'users_register', 'Registro de Usuarios');
    $lang_update_queries[] = PT_UpdateLangs($value, 'share_link', 'Compartir enlace');
    $lang_update_queries[] = PT_UpdateLangs($value, 'add', 'A??adir');
    $lang_update_queries[] = PT_UpdateLangs($value, 'add_money', 'Agregar dinero');
    $lang_update_queries[] = PT_UpdateLangs($value, 'free_member', 'miembro gratuito');
    $lang_update_queries[] = PT_UpdateLangs($value, 'stay_free', 'Mantente Libre');
    $lang_update_queries[] = PT_UpdateLangs($value, 'enjoy_more_features', 'Disfrute de m??s caracter??sticas con nuestro paquete pro!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'join_pro', '??nete a Pro!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promote_up', 'Promocionar hasta');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_requets', 'Solicitudes de financiaci??n');
        } else if ($value == 'turkish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'Ortaklar??m');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users', 'Bize y??nlendirdi??iniz her kullan??c?? i??in ${amount} kadar kazan??n!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users_pro', 'Bize y??nlendirdi??iniz her kullan??c?? i??in ${amount} kadar kazan??n ve profesyonel paketlerimize abone olun.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'your_ref_link', 'Ortakl??k ba??lant??n??z');
    $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Payla??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'liked_my_comment', 'yorumumu be??endim');
    $lang_update_queries[] = PT_UpdateLangs($value, 'liked_ur_comment', 'yorumunu be??endim');
    $lang_update_queries[] = PT_UpdateLangs($value, 'reply_ur_comment', 'yorumuna cevap verdi');
    $lang_update_queries[] = PT_UpdateLangs($value, 'replied_my_comment', 'yorumuma cevap verdi');
    $lang_update_queries[] = PT_UpdateLangs($value, 'go_pro', 'Pro git');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade_to_pro', 'Pro\'ya y??kselt');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade', 'Y??kselt');
    $lang_update_queries[] = PT_UpdateLangs($value, 'choose_method', 'Bir ??deme y??ntemi se??in');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upgraded', 'Y??kseltilmi??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'c_payment', '??demenizi onaylay??n, l??tfen bekleyin ..');
    $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', '??deme reddedildi, l??tfen daha sonra tekrar deneyin.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'banka transferi');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer_request', '??ste??iniz ba??ar??yla g??nderildi, onayland??????nda size bildirece??iz.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
    $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Kredi kart??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pro_members', 'Pro ??yeler');
    $lang_update_queries[] = PT_UpdateLangs($value, 'boost_post', 'G??nderiyi Art??r');
    $lang_update_queries[] = PT_UpdateLangs($value, 'unboost_post', 'G??nderiyi Kald??r');
    $lang_update_queries[] = PT_UpdateLangs($value, 'new_profile', 'Pro Profili');
    $lang_update_queries[] = PT_UpdateLangs($value, 'default_profile', 'Varsay??lan Profil');
    $lang_update_queries[] = PT_UpdateLangs($value, 'profile_style', 'Profil Stili');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pro_member', 'Pro ??yesi');
    $lang_update_queries[] = PT_UpdateLangs($value, 'boosted_posts', 'Y??kseltilmi?? G??nderiler');
    $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'C??zdan');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_decline', 'Banka dekontunuz reddedildi!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bank_pro', 'Banka dekontunuz onayland??!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'rekl??m');
    $lang_update_queries[] = PT_UpdateLangs($value, 'id', '??D');
    $lang_update_queries[] = PT_UpdateLangs($value, 'company', '??irket');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bidding', 'teklif verme');
    $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'T??klanma');
    $lang_update_queries[] = PT_UpdateLangs($value, 'views', 'G??r??n??mler');
    $lang_update_queries[] = PT_UpdateLangs($value, 'status', 'durum');
    $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Aksiyon');
    $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'yaratmak');
    $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'Hedef URL');
    $lang_update_queries[] = PT_UpdateLangs($value, 'title', 'Ba??l??k');
    $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'A????klama');
    $lang_update_queries[] = PT_UpdateLangs($value, 'location', 'yer');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'T??klama Ba????na ??deme ({{PRICE}})');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_imprssion', 'G??sterim Ba????na ??deme ({{PRICE}})');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sidebar', 'Kenar ??ubu??u');
    $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Yerle??tirme');
    $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Foto??raf y??kle');
    $lang_update_queries[] = PT_UpdateLangs($value, 'submit', 'G??nder');
    $lang_update_queries[] = PT_UpdateLangs($value, 'url_invalid', 'L??tfen ge??erli bir URL kullan??n.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'top_wallet', 'L??tfen c??zdan??n?? doldur.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_created', 'Reklam??n??z ba??ar??yla olu??turuldu.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'all', 'Her??ey');
    $lang_update_queries[] = PT_UpdateLangs($value, 'media_not_supported', 'Medya dosyas?? desteklenmiyor.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_edited', 'Reklam??n??z ba??ar??yla g??ncellendi.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'ad_not_found', 'Reklam bulunamad??.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'not_active', 'Aktif de??il');
    $lang_update_queries[] = PT_UpdateLangs($value, 'delete_ad', 'Reklam?? Sil');
    $lang_update_queries[] = PT_UpdateLangs($value, 'confirm_del_ad', 'Bu reklam?? silmek istedi??inize emin misiniz? bu i??lem geri al??namaz.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Reklam?? D??zenle');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sponsored', 'Sponsor');
    $lang_update_queries[] = PT_UpdateLangs($value, 'featured_member', '??ne ????kan ??ye');
    $lang_update_queries[] = PT_UpdateLangs($value, 'verified_badge', 'Do??rulanm???? rozet');
    $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promotion', 'Yay??n promosyonu');
    $lang_update_queries[] = PT_UpdateLangs($value, 'profile_Style', 'Benzersiz Profil Stili');
    $lang_update_queries[] = PT_UpdateLangs($value, 'please_wait', 'L??tfen bekle..');
    $lang_update_queries[] = PT_UpdateLangs($value, 'business_account', '???? hesab??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'account_analytics', 'Hesap analiti??i');
    $lang_update_queries[] = PT_UpdateLangs($value, 'today', 'Bug??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_week', 'Bu hafta');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_month', 'Bu ay');
    $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'Bu y??l');
    $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw', 'Para ??ekme');
    $lang_update_queries[] = PT_UpdateLangs($value, 'available_balance', 'Kalan bakiye');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paypal_email', 'PayPal E-posta');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Miktar');
    $lang_update_queries[] = PT_UpdateLangs($value, 'min', 'Min');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount_more_balance', '??stenen miktar, ger??ek bakiyenizden fazla olamaz.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'amount_less_50', '??stenilen miktardan az olamaz');
    $lang_update_queries[] = PT_UpdateLangs($value, 'cant_request_withdrawal', '??nceki istekler onaylan??p reddedilene kadar para ??ekme talebi g??nderemezsiniz.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'withdrawal_request_sent', 'Para ??ekme iste??iniz ba??ar??yla g??nderildi!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'requested_at', 'Talep edildi');
    $lang_update_queries[] = PT_UpdateLangs($value, 'paid', '??cretli');
    $lang_update_queries[] = PT_UpdateLangs($value, 'pending', 'kadar');
    $lang_update_queries[] = PT_UpdateLangs($value, 'declined', 'Reddedilen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'raise_money', 'Para toplamak');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_acquisition', 'Yeni fon talebi yarat');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_created', 'Finansman iste??i ba??ar??yla olu??turuldu.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'raised_of', 'Y??kseltilmi??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding', 'Yeni fon talebi yarat');
    $lang_update_queries[] = PT_UpdateLangs($value, 'load_more', 'Daha fazla y??kle');
    $lang_update_queries[] = PT_UpdateLangs($value, 'donate', 'ba??????lamak');
    $lang_update_queries[] = PT_UpdateLangs($value, 'fund_not_found', 'Fon talebi bulunamad??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'donated', 'Sana ba??????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'recent_donations', 'Son ba??????lar');
    $lang_update_queries[] = PT_UpdateLangs($value, 'total_donations', 'Toplam ba??????');
    $lang_update_queries[] = PT_UpdateLangs($value, 'user_funding', 'Finansman Talepleri');
    $lang_update_queries[] = PT_UpdateLangs($value, 'no_funding_yet', 'Hen??z bir fon talebi yok.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'requested', 'Talep edilen');
    $lang_update_queries[] = PT_UpdateLangs($value, 'follow_requests', '??stekleri takip et');
    $lang_update_queries[] = PT_UpdateLangs($value, 'is_following_you', '??imdi seni takip ediyor');
    $lang_update_queries[] = PT_UpdateLangs($value, 'accept_request', 'takip iste??ini kabul et');
    $lang_update_queries[] = PT_UpdateLangs($value, 'accept', 'Kabul etmek');
    $lang_update_queries[] = PT_UpdateLangs($value, 'u_dont_have_requests', 'Herhangi bir iste??iniz yok');
    $lang_update_queries[] = PT_UpdateLangs($value, 'business_name', 'i?? ad??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Telefon numaras??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bus_request_done', '??ste??iniz g??nderildi ve incelendi.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'edit_funding', 'Finansman talebini d??zenle');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_edited', 'Fon talebi ba??ar??yla g??ncellendi.');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_now', '??imdi ara');
    $lang_update_queries[] = PT_UpdateLangs($value, 'go_to', 'Git');
    $lang_update_queries[] = PT_UpdateLangs($value, 'send_email', 'Eposta g??nder');
    $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Daha fazla oku');
    $lang_update_queries[] = PT_UpdateLangs($value, 'shop_now', '??imdi sat??n al');
    $lang_update_queries[] = PT_UpdateLangs($value, 'view_now', '??imdi g??ster');
    $lang_update_queries[] = PT_UpdateLangs($value, 'visit_now', '??imdi ziyaret');
    $lang_update_queries[] = PT_UpdateLangs($value, 'book_now', '??imdi rezervasyon yap');
    $lang_update_queries[] = PT_UpdateLangs($value, 'learn_more', 'Daha fazla bilgi edin');
    $lang_update_queries[] = PT_UpdateLangs($value, 'play_now', '??imdi oyna');
    $lang_update_queries[] = PT_UpdateLangs($value, 'bet_now', '??imdi bahis yap');
    $lang_update_queries[] = PT_UpdateLangs($value, 'apply_here', 'Buraya uygula');
    $lang_update_queries[] = PT_UpdateLangs($value, 'quote_here', 'Burada al??nt?? yap');
    $lang_update_queries[] = PT_UpdateLangs($value, 'order_now', '??imdi sipari?? ver');
    $lang_update_queries[] = PT_UpdateLangs($value, 'book_tickets', 'Kitap biletleri');
    $lang_update_queries[] = PT_UpdateLangs($value, 'enroll_now', '??imdi kay??t');
    $lang_update_queries[] = PT_UpdateLangs($value, 'find_card', 'Bir kart bul');
    $lang_update_queries[] = PT_UpdateLangs($value, 'get_quote', 'Bir teklif al??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'get_tickets', 'Bilet al');
    $lang_update_queries[] = PT_UpdateLangs($value, 'locate_dealer', 'Bir sat??c?? bulun');
    $lang_update_queries[] = PT_UpdateLangs($value, 'order_online', 'Online sipari?? ver');
    $lang_update_queries[] = PT_UpdateLangs($value, 'preorder_now', '??n sipari?? ver');
    $lang_update_queries[] = PT_UpdateLangs($value, 'schedule_now', '??imdi planla');
    $lang_update_queries[] = PT_UpdateLangs($value, 'sign_up_now', '??imdi kay??t ol');
    $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Abone ol');
    $lang_update_queries[] = PT_UpdateLangs($value, 'register_now', '??imdi ??ye Ol');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_target_url', 'URL\'yi hedeflemek i??in aray??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_action', 'Eylem ??a??r??s??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'reply', 'cevap');
    $lang_update_queries[] = PT_UpdateLangs($value, 'how_it_works', 'Nas??l ??al??????r');
    $lang_update_queries[] = PT_UpdateLangs($value, 'earn_money', 'Para kazan');
    $lang_update_queries[] = PT_UpdateLangs($value, 'users_register', 'Kullan??c??lar Kay??t');
    $lang_update_queries[] = PT_UpdateLangs($value, 'share_link', 'Linki payla??');
    $lang_update_queries[] = PT_UpdateLangs($value, 'add', 'Eklemek');
    $lang_update_queries[] = PT_UpdateLangs($value, 'add_money', 'Para ekle');
    $lang_update_queries[] = PT_UpdateLangs($value, 'free_member', '??cretsiz ??ye');
    $lang_update_queries[] = PT_UpdateLangs($value, 'stay_free', '??cretsiz kal??n');
    $lang_update_queries[] = PT_UpdateLangs($value, 'enjoy_more_features', 'Profesyonel paketi olmayan daha fazla ??zelli??in tad??n?? ????kar??n!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'join_pro', 'Pro\'ya kat??l!');
    $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promote_up', 'Kadar terfi');
    $lang_update_queries[] = PT_UpdateLangs($value, 'funding_requets', 'Finansman Talepleri');
        } else if ($value == 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'My Affiliates');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users', 'Earn up to ${amount} for each user your refer to us !');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users_pro', 'Earn up to ${amount} for each user your refer to us and will subscribe to any of our pro packages.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ref_link', 'Your affiliate link is');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Share to');
            $lang_update_queries[] = PT_UpdateLangs($value, 'liked_my_comment', 'liked my comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'liked_ur_comment', 'liked your comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reply_ur_comment', 'replied to your comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replied_my_comment', 'replied to my comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_pro', 'Go Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade_to_pro', 'Upgrade To Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade', 'Upgrade');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_method', 'Choose a payment method');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgraded', 'Upgraded');
            $lang_update_queries[] = PT_UpdateLangs($value, 'c_payment', 'Confirming your payment, please wait..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Payment declined, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Bank transfer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer_request', 'Your request has been successfully sent, we will notify you once it\'s approved.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Credit Card');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_members', 'Pro Members');
            $lang_update_queries[] = PT_UpdateLangs($value, 'boost_post', 'Boost Post');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unboost_post', 'UnBoost Post');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_profile', 'Pro Profile');
            $lang_update_queries[] = PT_UpdateLangs($value, 'default_profile', 'Default Profile');
            $lang_update_queries[] = PT_UpdateLangs($value, 'profile_style', 'Profile Style');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_member', 'Pro Member');
            $lang_update_queries[] = PT_UpdateLangs($value, 'boosted_posts', 'Boosted Posts');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Wallet');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_decline', 'Your bank receipt has been declined!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_pro', 'Your bank receipt has been approved!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'Advertising');
            $lang_update_queries[] = PT_UpdateLangs($value, 'id', 'ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'company', 'Company');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bidding', 'Bidding');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Clicks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'views', 'Views');
            $lang_update_queries[] = PT_UpdateLangs($value, 'status', 'Status');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Action');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Create');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'Target URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'title', 'Title');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Description');
            $lang_update_queries[] = PT_UpdateLangs($value, 'location', 'Location');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Pay Per Click ({{PRICE}})');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_imprssion', 'Pay Per Impression ({{PRICE}})');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sidebar', 'Sidebar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Placement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Upload Photo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit', 'Submit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url_invalid', 'Please use a valid URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_wallet', 'Please top up your wallet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_created', 'Your ad has been successfully created.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'all', 'All');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_not_supported', 'Media file is not supported.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_edited', 'Your ad has been successfully updated.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_not_found', 'Ad not found.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_active', 'Not Active');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_ad', 'Delete Ad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirm_del_ad', 'Are you sure you want to delete this ad? this action can not be undo.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Edit Ad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsored', 'Sponsored');
            $lang_update_queries[] = PT_UpdateLangs($value, 'featured_member', 'Featured member');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified_badge', 'Verified badge');
            $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promotion', 'Posts promotion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'profile_Style', 'Unique Profile Style');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_wait', 'Please Wait..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'business_account', 'Business account');
            $lang_update_queries[] = PT_UpdateLangs($value, 'account_analytics', 'Account analytics');
            $lang_update_queries[] = PT_UpdateLangs($value, 'today', 'Today');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_week', 'This Week');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_month', 'This Month');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'This Year');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw', 'Withdrawal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_balance', 'Available Balance');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal_email', 'PayPal E-mail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Amount');
            $lang_update_queries[] = PT_UpdateLangs($value, 'min', 'Min');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount_more_balance', 'The requested amount can not be more than your actual balance.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount_less_50', 'The requested amount can not be less than');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cant_request_withdrawal', 'You can not submit withdrawal request until the previous requests has been approved / rejected.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdrawal_request_sent', 'Your withdrawal request has been successfully sent!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'requested_at', 'Requested at');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paid', 'Paid');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pending', 'Pending');
            $lang_update_queries[] = PT_UpdateLangs($value, 'declined', 'Declined');
            $lang_update_queries[] = PT_UpdateLangs($value, 'raise_money', 'Raise Money');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_acquisition', 'Create new funding request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_created', 'Funding request has been successfully created.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'raised_of', 'Raised of');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding', 'Create new funding request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more', 'Load More');
            $lang_update_queries[] = PT_UpdateLangs($value, 'donate', 'Donate');
            $lang_update_queries[] = PT_UpdateLangs($value, 'fund_not_found', 'Funding request not found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'donated', 'donated to your request.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'recent_donations', 'Recent donations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'total_donations', 'Total donations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_funding', 'Funding Requests');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_funding_yet', 'There are no funding requests yet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'requested', 'Requested');
            $lang_update_queries[] = PT_UpdateLangs($value, 'follow_requests', 'Follow Requests');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_following_you', 'is following you now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'accept_request', 'accepted your follow request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'accept', 'Accept');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_dont_have_requests', 'You do not have any requests');
            $lang_update_queries[] = PT_UpdateLangs($value, 'business_name', 'Business Name');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Phone Number');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bus_request_done', 'Your request has been submitted and under review.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_funding', 'Edit funding request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_edited', 'Funding request has been successfully updated.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_now', 'Call now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_to', 'Go to');
            $lang_update_queries[] = PT_UpdateLangs($value, 'send_email', 'Send email');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Read more');
            $lang_update_queries[] = PT_UpdateLangs($value, 'shop_now', 'Shop now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_now', 'View now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'visit_now', 'Visit now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'book_now', 'Book now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'learn_more', 'Learn more');
            $lang_update_queries[] = PT_UpdateLangs($value, 'play_now', 'Play now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bet_now', 'Bet now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apply_here', 'Apply here');
            $lang_update_queries[] = PT_UpdateLangs($value, 'quote_here', 'Quote here');
            $lang_update_queries[] = PT_UpdateLangs($value, 'order_now', 'Order now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'book_tickets', 'Book tickets');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enroll_now', 'Enroll now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'find_card', 'Find a card');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_quote', 'Get a quote');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_tickets', 'Get tickets');
            $lang_update_queries[] = PT_UpdateLangs($value, 'locate_dealer', 'Locate a dealer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'order_online', 'Order online');
            $lang_update_queries[] = PT_UpdateLangs($value, 'preorder_now', 'Preorder now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'schedule_now', 'Schedule now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sign_up_now', 'Sign up now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Subscribe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'register_now', 'Register now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_target_url', 'Call to target url');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_action', 'Call to action');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reply', 'Reply');
            $lang_update_queries[] = PT_UpdateLangs($value, 'how_it_works', 'How it works');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_money', 'Earn Money');
            $lang_update_queries[] = PT_UpdateLangs($value, 'users_register', 'Users Register');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_link', 'Share Link');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add', 'Add');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_money', 'Add Money');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_member', 'Free Member');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stay_free', 'Stay Free');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enjoy_more_features', 'Enjoy more Features with out pro package!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'join_pro', 'Join Pro!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promote_up', 'Promote up to');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_requets', 'Funding Requests');
        } else if ($value != 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_affiliates', 'My Affiliates');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users', 'Earn up to ${amount} for each user your refer to us !');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_users_pro', 'Earn up to ${amount} for each user your refer to us and will subscribe to any of our pro packages.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_ref_link', 'Your affiliate link is');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_to', 'Share to');
            $lang_update_queries[] = PT_UpdateLangs($value, 'liked_my_comment', 'liked my comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'liked_ur_comment', 'liked your comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reply_ur_comment', 'replied to your comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replied_my_comment', 'replied to my comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_pro', 'Go Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade_to_pro', 'Upgrade To Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgrade', 'Upgrade');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_method', 'Choose a payment method');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upgraded', 'Upgraded');
            $lang_update_queries[] = PT_UpdateLangs($value, 'c_payment', 'Confirming your payment, please wait..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Payment declined, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Bank transfer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer_request', 'Your request has been successfully sent, we will notify you once it\'s approved.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Credit Card');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_members', 'Pro Members');
            $lang_update_queries[] = PT_UpdateLangs($value, 'boost_post', 'Boost Post');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unboost_post', 'UnBoost Post');
            $lang_update_queries[] = PT_UpdateLangs($value, 'new_profile', 'Pro Profile');
            $lang_update_queries[] = PT_UpdateLangs($value, 'default_profile', 'Default Profile');
            $lang_update_queries[] = PT_UpdateLangs($value, 'profile_style', 'Profile Style');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_member', 'Pro Member');
            $lang_update_queries[] = PT_UpdateLangs($value, 'boosted_posts', 'Boosted Posts');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wallet', 'Wallet');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_decline', 'Your bank receipt has been declined!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_pro', 'Your bank receipt has been approved!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'advertising', 'Advertising');
            $lang_update_queries[] = PT_UpdateLangs($value, 'id', 'ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'company', 'Company');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bidding', 'Bidding');
            $lang_update_queries[] = PT_UpdateLangs($value, 'clicks', 'Clicks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'views', 'Views');
            $lang_update_queries[] = PT_UpdateLangs($value, 'status', 'Status');
            $lang_update_queries[] = PT_UpdateLangs($value, 'action', 'Action');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Create');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'Target URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'title', 'Title');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Description');
            $lang_update_queries[] = PT_UpdateLangs($value, 'location', 'Location');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_click', 'Pay Per Click ({{PRICE}})');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_per_imprssion', 'Pay Per Impression ({{PRICE}})');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sidebar', 'Sidebar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'placement', 'Placement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_file', 'Upload Photo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit', 'Submit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url_invalid', 'Please use a valid URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'top_wallet', 'Please top up your wallet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_created', 'Your ad has been successfully created.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'all', 'All');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media_not_supported', 'Media file is not supported.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_edited', 'Your ad has been successfully updated.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ad_not_found', 'Ad not found.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_active', 'Not Active');
            $lang_update_queries[] = PT_UpdateLangs($value, 'delete_ad', 'Delete Ad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirm_del_ad', 'Are you sure you want to delete this ad? this action can not be undo.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_ad', 'Edit Ad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sponsored', 'Sponsored');
            $lang_update_queries[] = PT_UpdateLangs($value, 'featured_member', 'Featured member');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified_badge', 'Verified badge');
            $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promotion', 'Posts promotion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'profile_Style', 'Unique Profile Style');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_wait', 'Please Wait..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'business_account', 'Business account');
            $lang_update_queries[] = PT_UpdateLangs($value, 'account_analytics', 'Account analytics');
            $lang_update_queries[] = PT_UpdateLangs($value, 'today', 'Today');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_week', 'This Week');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_month', 'This Month');
            $lang_update_queries[] = PT_UpdateLangs($value, 'this_year', 'This Year');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw', 'Withdrawal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_balance', 'Available Balance');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal_email', 'PayPal E-mail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Amount');
            $lang_update_queries[] = PT_UpdateLangs($value, 'min', 'Min');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount_more_balance', 'The requested amount can not be more than your actual balance.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount_less_50', 'The requested amount can not be less than');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cant_request_withdrawal', 'You can not submit withdrawal request until the previous requests has been approved / rejected.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdrawal_request_sent', 'Your withdrawal request has been successfully sent!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'requested_at', 'Requested at');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paid', 'Paid');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pending', 'Pending');
            $lang_update_queries[] = PT_UpdateLangs($value, 'declined', 'Declined');
            $lang_update_queries[] = PT_UpdateLangs($value, 'raise_money', 'Raise Money');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_acquisition', 'Create new funding request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_created', 'Funding request has been successfully created.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'raised_of', 'Raised of');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding', 'Create new funding request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more', 'Load More');
            $lang_update_queries[] = PT_UpdateLangs($value, 'donate', 'Donate');
            $lang_update_queries[] = PT_UpdateLangs($value, 'fund_not_found', 'Funding request not found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'donated', 'donated to your request.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'recent_donations', 'Recent donations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'total_donations', 'Total donations');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_funding', 'Funding Requests');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_funding_yet', 'There are no funding requests yet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'requested', 'Requested');
            $lang_update_queries[] = PT_UpdateLangs($value, 'follow_requests', 'Follow Requests');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_following_you', 'is following you now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'accept_request', 'accepted your follow request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'accept', 'Accept');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_dont_have_requests', 'You do not have any requests');
            $lang_update_queries[] = PT_UpdateLangs($value, 'business_name', 'Business Name');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Phone Number');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bus_request_done', 'Your request has been submitted and under review.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'edit_funding', 'Edit funding request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_edited', 'Funding request has been successfully updated.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_now', 'Call now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_to', 'Go to');
            $lang_update_queries[] = PT_UpdateLangs($value, 'send_email', 'Send email');
            $lang_update_queries[] = PT_UpdateLangs($value, 'read_more', 'Read more');
            $lang_update_queries[] = PT_UpdateLangs($value, 'shop_now', 'Shop now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'view_now', 'View now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'visit_now', 'Visit now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'book_now', 'Book now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'learn_more', 'Learn more');
            $lang_update_queries[] = PT_UpdateLangs($value, 'play_now', 'Play now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bet_now', 'Bet now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apply_here', 'Apply here');
            $lang_update_queries[] = PT_UpdateLangs($value, 'quote_here', 'Quote here');
            $lang_update_queries[] = PT_UpdateLangs($value, 'order_now', 'Order now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'book_tickets', 'Book tickets');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enroll_now', 'Enroll now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'find_card', 'Find a card');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_quote', 'Get a quote');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_tickets', 'Get tickets');
            $lang_update_queries[] = PT_UpdateLangs($value, 'locate_dealer', 'Locate a dealer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'order_online', 'Order online');
            $lang_update_queries[] = PT_UpdateLangs($value, 'preorder_now', 'Preorder now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'schedule_now', 'Schedule now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sign_up_now', 'Sign up now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Subscribe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'register_now', 'Register now');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_target_url', 'Call to target url');
            $lang_update_queries[] = PT_UpdateLangs($value, 'call_to_action', 'Call to action');
            $lang_update_queries[] = PT_UpdateLangs($value, 'reply', 'Reply');
            $lang_update_queries[] = PT_UpdateLangs($value, 'how_it_works', 'How it works');
            $lang_update_queries[] = PT_UpdateLangs($value, 'earn_money', 'Earn Money');
            $lang_update_queries[] = PT_UpdateLangs($value, 'users_register', 'Users Register');
            $lang_update_queries[] = PT_UpdateLangs($value, 'share_link', 'Share Link');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add', 'Add');
            $lang_update_queries[] = PT_UpdateLangs($value, 'add_money', 'Add Money');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_member', 'Free Member');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stay_free', 'Stay Free');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enjoy_more_features', 'Enjoy more Features with out pro package!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'join_pro', 'Join Pro!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'posts_promote_up', 'Promote up to');
            $lang_update_queries[] = PT_UpdateLangs($value, 'funding_requets', 'Funding Requests');
        }
    }
    if (!empty($lang_update_queries)) {
        foreach ($lang_update_queries as $key => $query) {
            $sql = mysqli_query($mysqli, $query);
        }
    }
    
    $name = md5(microtime()) . '_updated.php';
    // rename('update.php', $name);
}
?>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <title>Updating PixelPhoto</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <style>
         @import url('https://fonts.googleapis.com/css?family=Roboto:400,500');
         @media print {
            .wo_update_changelog {max-height: none !important; min-height: !important}
            .btn, .hide_print, .setting-well h4 {display:none;}
         }
         * {outline: none !important;}
         body {background: #f3f3f3;font-family: 'Roboto', sans-serif;}
         .light {font-weight: 400;}
         .bold {font-weight: 500;}
         .btn {height: 52px;line-height: 1;font-size: 16px;transition: all 0.3s;border-radius: 2em;font-weight: 500;padding: 0 28px;letter-spacing: .5px;}
         .btn svg {margin-left: 10px;margin-top: -2px;transition: all 0.3s;vertical-align: middle;}
         .btn:hover svg {-webkit-transform: translateX(3px);-moz-transform: translateX(3px);-ms-transform: translateX(3px);-o-transform: translateX(3px);transform: translateX(3px);}
         .btn-main {color: #ffffff;background-color: #00BCD4;border-color: #00BCD4;}
         .btn-main:disabled, .btn-main:focus {color: #fff;}
         .btn-main:hover {color: #ffffff;background-color: #0dcde2;border-color: #0dcde2;box-shadow: -2px 2px 14px rgba(168, 72, 73, 0.35);}
         svg {vertical-align: middle;}
         .main {color: #00BCD4;}
         .wo_update_changelog {
          border: 1px solid #eee;
          padding: 10px !important;
         }
         .content-container {display: -webkit-box; width: 100%;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-flex-direction: column;flex-direction: column;min-height: 100vh;position: relative;}
         .content-container:before, .content-container:after {-webkit-box-flex: 1;box-flex: 1;-webkit-flex-grow: 1;flex-grow: 1;content: '';display: block;height: 50px;}
         .wo_install_wiz {position: relative;background-color: white;box-shadow: 0 1px 15px 2px rgba(0, 0, 0, 0.1);border-radius: 10px;padding: 20px 30px;border-top: 1px solid rgba(0, 0, 0, 0.04);}
         .wo_install_wiz h2 {margin-top: 10px;margin-bottom: 30px;display: flex;align-items: center;}
         .wo_install_wiz h2 span {margin-left: auto;font-size: 15px;}
         .wo_update_changelog {padding:0;list-style-type: none;margin-bottom: 15px;max-height: 440px;overflow-y: auto; min-height: 440px;}
         .wo_update_changelog li {margin-bottom:7px; max-height: 20px; overflow: hidden;}
         .wo_update_changelog li span {padding: 2px 7px;font-size: 12px;margin-right: 4px;border-radius: 2px;}
         .wo_update_changelog li span.added {background-color: #4CAF50;color: white;}
         .wo_update_changelog li span.changed {background-color: #e62117;color: white;}
         .wo_update_changelog li span.improved {background-color: #9C27B0;color: white;}
         .wo_update_changelog li span.compressed {background-color: #795548;color: white;}
         .wo_update_changelog li span.fixed {background-color: #2196F3;color: white;}
         input.form-control {background-color: #f4f4f4;border: 0;border-radius: 2em;height: 40px;padding: 3px 14px;color: #383838;transition: all 0.2s;}
input.form-control:hover {background-color: #e9e9e9;}
input.form-control:focus {background: #fff;box-shadow: 0 0 0 1.5px #a84849;}
         .empty_state {margin-top: 80px;margin-bottom: 80px;font-weight: 500;color: #6d6d6d;display: block;text-align: center;}
         .checkmark__circle {stroke-dasharray: 166;stroke-dashoffset: 166;stroke-width: 2;stroke-miterlimit: 10;stroke: #7ac142;fill: none;animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;}
         .checkmark {width: 80px;height: 80px; border-radius: 50%;display: block;stroke-width: 3;stroke: #fff;stroke-miterlimit: 10;margin: 100px auto 50px;box-shadow: inset 0px 0px 0px #7ac142;animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;}
         .checkmark__check {transform-origin: 50% 50%;stroke-dasharray: 48;stroke-dashoffset: 48;animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;}
         @keyframes stroke { 100% {stroke-dashoffset: 0;}}
         @keyframes scale {0%, 100% {transform: none;}  50% {transform: scale3d(1.1, 1.1, 1); }}
         @keyframes fill { 100% {box-shadow: inset 0px 0px 0px 54px #7ac142; }}
      </style>
   </head>
   <body>
      <div class="content-container container">
         <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
               <div class="wo_install_wiz">
                 <?php if ($updated == false) { ?>
                  <div>
                     <h2 class="light">Update to v1.2 </span></h2>
                     <div class="setting-well">
                        <h4>Changelog</h4>
                        <ul class="wo_update_changelog">
                            <li>[Added] like comment system.</li>
                            <li>[Added] reply to comment system. </li>
                            <li>[Added] affiliate system. </li>
                            <li>[Added] more payment methods, bank transfer, stripe.</li>
                            <li>[Added] the ability to pause the story if you click on it.</li>
                            <li>[Added] To add money in the wallet from admin panel. </li>
                            <li>[Added] Ads system for users, users now can advertise on your site.</li>
                            <li>[Added] pro system, with new profile layout. </li>
                            <li>[Added] raise money system, photographers can ask for funding and get funded by users.</li>
                            <li>[Added] business account like Instagram.</li>
                            <li>[Added] follow requests, now if profile is private, it is required to accept a follow request before viewing the posts. </li>
                            <li>[Removed] @ from user profile url. </li>
                            <li>[Organized] Admin panel, added search for some pages, select all for posts, etc. </li>
                            <li>[Updated] Password hash system from sha1 to password_hash PHP function. </li>
                            <li>[Fixed] few important bugs.</li>
                            <li>[Improved] speed.</li>
                        </ul>
                        <p class="hide_print">Note: The update process might take few minutes.</p>
                        <p class="hide_print">Important: If you got any fail queries, please copy them, open a support ticket and send us the details.</p>
                        <br>
                             <button class="pull-right btn btn-default" onclick="window.print();">Share Log</button>
                             <button type="button" class="btn btn-main" id="button-update">
                             Update 
                             <svg viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
                                <path fill="currentColor" d="M18.6 6.9v-.5l-6-6c-.3-.3-.9-.3-1.2 0-.3.3-.3.9 0 1.2l5 5H1c-.5 0-.9.4-.9.9s.4.8.9.8h14.4l-4 4.1c-.3.3-.3.9 0 1.2.2.2.4.2.6.2.2 0 .4-.1.6-.2l5.2-5.2h.2c.5 0 .8-.4.8-.8 0-.3 0-.5-.2-.7z"></path>
                             </svg>
                          </button>
                     </div>
                     <?php }?>
                     <?php if ($updated == true) { ?>
                      <div>
                        <div class="empty_state">
                           <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                           </svg>
                           <p>Congratulations, you have successfully updated your site. Thanks for choosing WoWonder.</p>
                           <br>
                           <a href="<?php echo $wo['config']['site_url'] ?>" class="btn btn-main" style="line-height:50px;">Home</a>
                        </div>
                     </div>
                     <?php }?>
                  </div>
               </div>
            </div>
            <div class="col-md-1"></div>
         </div>
      </div>
   </body>
</html>
<script>  
var queries = [
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'affiliate_system', '1');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'affiliate_type', '1');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'amount_ref', '0.10');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'amount_percent_ref', '0');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'currency', 'USD');",
    "ALTER TABLE `pxp_users` ADD `balance` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' AFTER `device_id`;",
    "ALTER TABLE `pxp_users` ADD `referrer` INT(11) NOT NULL DEFAULT '0' AFTER `balance`;",
    "CREATE TABLE `pxp_comments_likes` (`id` int(11) NOT NULL AUTO_INCREMENT,`user_id` int(11) NOT NULL DEFAULT '0',`comment_id` int(11) NOT NULL DEFAULT '0',PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `pxp_comments_likes` ADD INDEX(`user_id`);",
    "ALTER TABLE `pxp_comments_likes` ADD INDEX(`comment_id`);",
    "ALTER TABLE `pxp_users` ADD `n_on_comment_like` ENUM('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' AFTER `n_on_follow`;",
    "CREATE TABLE `pxp_comments_reply` (`id` int(30) NOT NULL AUTO_INCREMENT,`comment_id` int(20) NOT NULL DEFAULT '0',`user_id` int(20) NOT NULL DEFAULT '0',`text` text,`time` varchar(100) NOT NULL DEFAULT '0',PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `pxp_comments_reply` ADD INDEX(`comment_id`);",
    "ALTER TABLE `pxp_comments_reply` ADD INDEX(`user_id`);",
    "CREATE TABLE `pxp_comments_reply_likes` (`id` int(11) NOT NULL AUTO_INCREMENT,`user_id` int(11) NOT NULL DEFAULT '0',`reply_id` int(11) NOT NULL DEFAULT '0',PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `pxp_comments_reply_likes` ADD INDEX(`user_id`);",
    "ALTER TABLE `pxp_comments_reply_likes` ADD INDEX(`reply_id`);",
    "ALTER TABLE `pxp_users` ADD INDEX(`n_on_comment_like`);",
    "ALTER TABLE `pxp_users` ADD `n_on_comment_reply` ENUM('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' AFTER `n_on_comment_like`;",
    "ALTER TABLE `pxp_users` ADD INDEX(`n_on_comment_reply`);",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'credit_card', 'off');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'stripe_secret', '');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'stripe_id', '');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'paypal_mode', 'live');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'paypal_id', '');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'paypal_secret', '');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'pro_price', '4');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'bank_payment', 'off');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'bank_transfer_note', 'In order to confirm the bank transfer, you will need to upload a receipt or take a screenshot of your transfer within 1 day from your payment date. If a bank transfer is made but no receipt is uploaded within this period, your order will be cancelled. We will verify and confirm your receipt within 3 working days from the date you upload it.');",
    "CREATE TABLE `pxp_bank_receipts` (`id` int(11) unsigned NOT NULL AUTO_INCREMENT,`user_id` int(11) unsigned NOT NULL DEFAULT '0',`description` tinytext NOT NULL,`price` varchar(50) NOT NULL DEFAULT '0',`mode` varchar(50) NOT NULL DEFAULT '',`approved` int(11) unsigned NOT NULL DEFAULT '0',`receipt_file` varchar(250) NOT NULL DEFAULT '',`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,`approved_at` int(11) unsigned NOT NULL DEFAULT '0',PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;",
    "CREATE TABLE `pxp_payments` (`id` int(11) NOT NULL AUTO_INCREMENT,`user_id` int(11) NOT NULL DEFAULT '0',`amount` int(11) NOT NULL DEFAULT '0',`type` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',`date` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',PRIMARY KEY (`id`),KEY `user_id` (`user_id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'pro_system', 'off');",
    "ALTER TABLE `pxp_posts` ADD `boosted` INT(11) NOT NULL DEFAULT '0' AFTER `views`;",
    "ALTER TABLE `pxp_users` ADD `profile` INT(11) NOT NULL DEFAULT '1' AFTER `referrer`;",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'boosted_posts', '4');",
    "ALTER TABLE `pxp_users` ADD `wallet` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0.00' AFTER `balance`;",
    "CREATE TABLE `pxp_userads` (`id` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(100) NOT NULL DEFAULT '',`url` varchar(3000) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',`headline` varchar(200) NOT NULL DEFAULT '',`description` text,`location` varchar(1000) NOT NULL DEFAULT 'us',`audience` longtext,`ad_media` varchar(3000) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',`gender` varchar(15) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL DEFAULT 'all',`bidding` varchar(15) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',`clicks` int(15) NOT NULL DEFAULT '0',`views` int(15) NOT NULL DEFAULT '0',`posted` varchar(15) NOT NULL DEFAULT '',`status` int(1) NOT NULL DEFAULT '1',`appears` varchar(10) NOT NULL DEFAULT 'post',`user_id` int(11) NOT NULL DEFAULT '0',PRIMARY KEY (`id`),KEY `appears` (`appears`),KEY `user_id` (`user_id`),KEY `location` (`location`(255)),KEY `gender` (`gender`),KEY `status` (`status`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'ad_c_price', '0.05');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'ad_v_price', '0.01');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'google_map', 'off');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'google_map_api', '');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'user_ads', 'on');",
    "ALTER TABLE `pxp_users` ADD `business_account` INT(11) NOT NULL DEFAULT '0' AFTER `profile`;",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'business_account', 'on');",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'withdraw_system', 'on');",
    "ALTER TABLE `pxp_users` ADD `paypal_email` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `business_account`;",
    "CREATE TABLE `pxp_withdrawal_requests` (`id` int(20) NOT NULL AUTO_INCREMENT,`user_id` int(11) NOT NULL DEFAULT '0',`email` varchar(200) NOT NULL DEFAULT '',`amount` varchar(100) NOT NULL DEFAULT '0',`currency` varchar(20) NOT NULL DEFAULT '',`requested` varchar(100) NOT NULL DEFAULT '',`status` int(5) NOT NULL DEFAULT '0',PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `pxp_config` CHANGE `value` `value` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'raise_money', 'on');",
    "ALTER TABLE `pxp_connectivities` ADD `type` INT(11) NOT NULL DEFAULT '1' AFTER `active`;",
    "CREATE TABLE `pxp_funding` (`id` int(11) NOT NULL AUTO_INCREMENT,`title` varchar(100) NOT NULL DEFAULT '',`description` varchar(600) NOT NULL DEFAULT '',`amount` varchar(11) NOT NULL DEFAULT '0',`user_id` int(11) NOT NULL DEFAULT '0',`image` varchar(200) NOT NULL DEFAULT '',`time` varchar(50) NOT NULL DEFAULT '',PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;",
    "CREATE TABLE `pxp_funding_raise` (`id` int(11) NOT NULL AUTO_INCREMENT,`funding_id` int(11) NOT NULL DEFAULT '0',`user_id` int(11) NOT NULL DEFAULT '0',`amount` varchar(11) NOT NULL DEFAULT '0',`time` varchar(50) NOT NULL DEFAULT '',PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;",
    "ALTER TABLE `pxp_connectivities` ADD `time` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `type`;",
    "ALTER TABLE `pxp_users` ADD `b_name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `paypal_email`, ADD `b_email` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `b_name`, ADD `b_phone` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `b_email`;",
    "CREATE TABLE `pxp_business_requests` (`id` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(100) NOT NULL DEFAULT '',`email` varchar(100) NOT NULL DEFAULT '',`phone` varchar(50) NOT NULL DEFAULT '',`site` varchar(200) NOT NULL DEFAULT '',`user_id` int(11) NOT NULL DEFAULT '0',`passport` text NOT NULL,`photo` text NOT NULL,`type` int(11) NOT NULL DEFAULT '0',`time` varchar(50) NOT NULL DEFAULT '',PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;",
    "ALTER TABLE `pxp_users` ADD `b_site` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `b_phone`;",
    "ALTER TABLE `pxp_users` ADD `b_site_action` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `b_site`;",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'raise_money_type', '1');",
    "ALTER TABLE `pxp_post_comments` CHANGE `text` `text` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;",
    "ALTER TABLE `pxp_bank_receipts` CHANGE `description` `description` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;",
    "ALTER TABLE `pxp_business_requests` CHANGE `passport` `passport` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;",
    "ALTER TABLE `pxp_business_requests` CHANGE `photo` `photo` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;",
    "ALTER TABLE `pxp_funding_raise` ADD INDEX(`user_id`);",
    "ALTER TABLE `pxp_funding_raise` ADD INDEX(`funding_id`);",
    "ALTER TABLE `pxp_posts` CHANGE `mp4` `mp4` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;",
    "ALTER TABLE `pxp_sessions` CHANGE `platform_details` `platform_details` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;",
    "ALTER TABLE `pxp_story` CHANGE `type` `type` ENUM('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1';",
    "ALTER TABLE `pxp_verification_requests` CHANGE `passport` `passport` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;",
    "ALTER TABLE `pxp_verification_requests` CHANGE `photo` `photo` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;",
    "ALTER TABLE `pxp_users` CHANGE `password` `password` VARCHAR(61) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '';",
    "ALTER TABLE `pxp_post_comments` CHANGE `text` `text` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;",
    "ALTER TABLE `pxp_comments_reply` CHANGE `text` `text` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;",
    "INSERT INTO `pxp_config` (`id`, `name`, `value`) VALUES (NULL, 'version', '1.2');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'my_affiliates');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'earn_users');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'earn_users_pro');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'your_ref_link');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'share_to');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'liked_my_comment');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'liked_ur_comment');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'reply_ur_comment');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'replied_my_comment');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'go_pro');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'upgrade_to_pro');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'upgrade');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'choose_method');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'upgraded');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'c_payment');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'payment_declined');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'bank_transfer');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'bank_transfer_request');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'paypal');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'credit_card');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'pro_members');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'boost_post');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'unboost_post');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'new_profile');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'default_profile');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'profile_style');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'pro_member');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'boosted_posts');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'wallet');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'bank_decline');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'bank_pro');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'advertising');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'id');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'company');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'bidding');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'clicks');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'views');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'status');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'action');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'create');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'url');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'title');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'description');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'location');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'pay_per_click');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'pay_per_imprssion');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'sidebar');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'placement');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'upload_file');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'submit');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'url_invalid');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'top_wallet');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'ad_created');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'all');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'media_not_supported');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'ad_edited');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'ad_not_found');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'not_active');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'delete_ad');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'confirm_del_ad');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'edit_ad');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'sponsored');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'featured_member');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'verified_badge');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'posts_promotion');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'profile_Style');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'please_wait');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'business_account');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'account_analytics');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'today');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'this_week');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'this_month');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'this_year');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'withdraw');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'available_balance');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'paypal_email');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'amount');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'min');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'amount_more_balance');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'amount_less_50');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'cant_request_withdrawal');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'withdrawal_request_sent');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'requested_at');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'paid');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'pending');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'declined');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'raise_money');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'funding_acquisition');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'funding_created');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'raised_of');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'funding');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'load_more');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'donate');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'fund_not_found');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'donated');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'recent_donations');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'total_donations');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'user_funding');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'no_funding_yet');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'requested');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'follow_requests');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'is_following_you');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'accept_request');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'accept');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'u_dont_have_requests');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'business_name');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'phone_number');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'bus_request_done');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'edit_funding');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'funding_edited');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'call_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'go_to');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'send_email');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'read_more');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'shop_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'view_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'visit_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'book_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'learn_more');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'play_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'bet_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'apply_here');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'quote_here');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'order_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'book_tickets');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'enroll_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'find_card');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'get_quote');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'get_tickets');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'locate_dealer');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'order_online');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'preorder_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'schedule_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'sign_up_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'subscribe');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'register_now');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'call_to_target_url');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'call_to_action');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'reply');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'how_it_works');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'earn_money');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'users_register');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'share_link');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'add');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'add_money');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'free_member');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'stay_free');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'enjoy_more_features');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'join_pro');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'posts_promote_up');",
    "INSERT INTO `pxp_langs` (`id`, `lang_key`) VALUES (NULL, 'funding_requets');",

];

$('#input_code').bind("paste keyup input propertychange", function(e) {
    if (isPurchaseCode($(this).val())) {
        $('#button-update').removeAttr('disabled');
    } else {
        $('#button-update').attr('disabled', 'true');
    }
});

function isPurchaseCode(str) {
    var patt = new RegExp("(.*)-(.*)-(.*)-(.*)-(.*)");
    var res = patt.test(str);
    if (res) {
        return true;
    }
    return false;
}

$(document).on('click', '#button-update', function(event) {
    if ($('body').attr('data-update') == 'true') {
        window.location.href = '<?php echo $site_url?>';
        return false;
    }
    $(this).attr('disabled', true);
    $('.wo_update_changelog').html('');
    $('.wo_update_changelog').css({
        background: '#1e2321',
        color: '#fff'
    });
    $('.setting-well h4').text('Updating..');
    $(this).attr('disabled', true);
    RunQuery();
});

var queriesLength = queries.length;
var query = queries[0];
var count = 0;
function b64EncodeUnicode(str) {
    // first we use encodeURIComponent to get percent-encoded UTF-8,
    // then we convert the percent encodings into raw bytes which
    // can be fed into btoa.
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
    }));
}
function RunQuery() {
    var query = queries[count];
    $.post('?update', {
        query: b64EncodeUnicode(query)
    }, function(data, textStatus, xhr) {
        if (data.status == 200) {
            $('.wo_update_changelog').append('<li><span class="added">SUCCESS</span> ~$ mysql > ' + query + '</li>');
        } else {
            $('.wo_update_changelog').append('<li><span class="changed">FAILED</span> ~$ mysql > ' + query + '</li>');
        }
        count = count + 1;
        if (queriesLength > count) {
            setTimeout(function() {
                RunQuery();
            }, 1500);
        } else {
            $('.wo_update_changelog').append('<li><span class="added">Updating Langauges</span> ~$ languages.sh, Please wait, this might take some time..</li>');
            $.post('?run_lang', {
                update_langs: 'true'
            }, function(data, textStatus, xhr) {
              $('.wo_update_changelog').append('<li><span class="fixed">Finished!</span> ~$ Congratulations! you have successfully updated your site. Thanks for choosing PixelPhoto.</li>');
              $('.setting-well h4').text('Update Log');
              $('#button-update').html('Home <svg viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="18" height="18"> <path fill="currentColor" d="M18.6 6.9v-.5l-6-6c-.3-.3-.9-.3-1.2 0-.3.3-.3.9 0 1.2l5 5H1c-.5 0-.9.4-.9.9s.4.8.9.8h14.4l-4 4.1c-.3.3-.3.9 0 1.2.2.2.4.2.6.2.2 0 .4-.1.6-.2l5.2-5.2h.2c.5 0 .8-.4.8-.8 0-.3 0-.5-.2-.7z"></path> </svg>');
              $('#button-update').attr('disabled', false);
              $(".wo_update_changelog").scrollTop($(".wo_update_changelog")[0].scrollHeight);
              $('body').attr('data-update', 'true');
            });
        }
        $(".wo_update_changelog").scrollTop($(".wo_update_changelog")[0].scrollHeight);
    });
}
</script>
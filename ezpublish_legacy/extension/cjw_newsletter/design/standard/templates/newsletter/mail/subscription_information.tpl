{*?template charset=utf-8?*}{set-block variable=$subject scope=root}{ezini('NewsletterMailSettings', 'EmailSubjectPrefix', 'cjw_newsletter.ini')} {'Subscription information'|i18n( 'cjw_newsletter/subscription_information' )}{/set-block}
{*
$newsletter_user
$hostname
*}
{def $subscriptionListString = ''}
{foreach $newsletter_user.subscription_array as $subscription}
{set $subscriptionListString = concat( $subscriptionListString, "\n- ", $subscription.newsletter_list.name|wash() )}
{/foreach}
{'Hola %name

Gracias por subscribirse a nuestro boletín electrónico.
Para confirmar su suscripción por favor pulse en el siguiente enlace: 
%configureLink
'|i18n( 'cjw_newsletter/mail/subscription_information',,
                                         hash( '%name', concat( $newsletter_user.first_name, ' ', $newsletter_user.last_name ),
                                               '%configureLink', concat( 'http://', $hostname, concat( '/newsletter/configure/', cond( $newsletter_user, $newsletter_user.hash, '#' ) )|ezurl(no) ),
                                               '%subscriptionList', $subscriptionListString,
                                                ) )}
{include uri="design:newsletter/mail/footer.tpl"}
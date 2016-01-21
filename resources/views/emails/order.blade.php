Hi <?php echo $user->name; ?>!

Je bestelling is zojuist geplaatst. De volgende maaltijden zijn voor je besteld:
@foreach ($orderLines as $orderline)
	{{$orderline->id}} - {{$orderline->amount}} <br/>
@endforeach

Je krijgt later nog een e-mail wanneer je bestelling klaar staat!

Groet, Krat en Klaar.
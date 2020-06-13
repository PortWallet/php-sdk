## PortWallet PHP SDK

### Installation
```
composer require portwallet/php-sdk
```

### Usage 
```
$portPay = new \PortWallet\PortWalletClient($apiKey, $apiSecret);
```

#### Retrieve an invoice
```
$invoice = $portPay->invoice->retrieve($invoiceId); // $invoiceId = 85ED8B0D14611209

PortWallet\Invoice {#304 ▼
  +invoice_id: "85ED8B0D14611209"
  +reference: "ABC123"
  +order: {#296 ▶}
  +product: {#292 ▶}
  +billing: {#297 ▶}
  +shipping: {#300 ▶}
  +customs: array:3 [▶]
}
```

#### Retrieve a recurring 
```
$recurring = $portPay->recurring->retrieve($invoiceId); // $invoiceId = 85EDC82FE2900875

PortWallet\Recurring {#301 ▼
  +id: "R85EDC82FE2900875"
  +status: "PENDING"
  +name: "Order #17339988"
  +description: "Bangobd Membership Individual (7-day trial: BDT 5) After trail period monthly BDT 100"
  +period: {#294 ▶}
  +has_trial: false
  +trial: {#296 ▶}
  +has_offers: false
  +offers: {#287 ▶}
  +is_prorated: true
  +payment: {#292 ▶}
  +started: "Sun, 07 Jun 2020 12:02:38 +0600"
  +ended_at: "Mon, 30 Nov 2020 23:59:59 +0600"
  +next_payment: {#291 ▶}
  +customer: {#295 ▶}
  +user_id: 0
  +source: {#297 ▶}
  +history: array:1 [▶]
}
```

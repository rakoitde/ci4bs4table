# Examples

## Table of Contents

- [Full Example](#Full-Example)
- [HTML output](#HTML-output)

## Full Example

```php
// Form
$form = new Form("myform");
$form->size("sm");

# Codeigniter 4 Request
$form->addRequest( \Config\Services::request() );

# Codeigniter 4 Vaidation
$this->validate([]);	
$this->validator->setRules([
    'vorname' => 'required',
    'nachname' => 'required',
    'checkbox' => 'required',
    'select' => 'required|alpha',
    'select2.*' => 'required|alpha',
    'password' => 'required|min_length[10]',
    'email'    => 'required|valid_email',
    'description' => 'required',
])->run();
$form->Validation($this->validator);

// FormGroups
$form->AddInput("id")->Label("ID")->Value("1")->Readonly();
$form->AddCheckbox("checkbox")->Label("Bitte auswählen");
$form->StartRow();
	$form->StartCol()->addClass("col-md-6");
		$form->AddSelect("select")->Options(["1","2","3","4"])->Label("Auswahl");
	$form->EndCol();
	$form->StartCol()->addClass("col-md-6");
		$form->AddSelect("select2")->Options(["a"=>"1","b"=>"2","c"=>"3","d"=>"4"])->Label("Auswahl")->Multiple();
	$form->EndCol();
$form->EndRow();
$form->StartRow();
	$form->StartCol()->addClass("col-md-4");
		$form->AddInput("vorname")->addClass("hidden")->Message("Der Vorname ist zwingend notwendig");
	$form->EndCol();
	$form->StartCol()->addClass("col-md-4");
		$form->AddInput("nachname")->Placeholder("Nachname");
	$form->EndCol();
	$form->StartCol()->addClass("col-md-4");
		$form->AddMail("email")->Label("E-Mail Adresse")->Placeholder("name@domain.de");
	$form->EndCol();
$form->EndRow();
$form->AddPassword("password")->Label("Passwort");
$form->AddFile("datei");
$form->AddTextarea("description")->Label("Beschreibung")->Rows("5");

// Buttons
$form->AddSubmitButton("submit")->Text("Speichern")->Color("success");
$form->AddButton("cancel")->Text("Abbruch")->Color("danger");
$form->AddButton("ajax")->Text("Ajax")->Color("primary");

$form2 = new Form();
$form2->addRequest( \Config\Services::request() );
$form2->Validation($this->validator);
$form2->fromJson($form->toJson());

#d($form->toHtml());	
```

## HTML output

In CodeIgniter 4 Controller
```php
// Form
$form = new Form("myform");
// FormGroups
$form->AddInput("id")->Label("ID");

$data = [
	'form' => $form,
];

return view('Viewname', $data);
```

In CodeIgniter 4 View

```html
<?= $form->toHtml() ?>
```


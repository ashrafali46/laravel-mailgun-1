# Laravel Mailgun
A simple project on how to send email with Laravel using Mailgun.

## Requirements
- [Mailgun](https://www.mailgun.com/)
- AMPPS, WAMP, XAMPP or MAMP (Optional)
- Homestead (Recommended)
- Composer 1.6.5
- PHP 7.2.7

## Getting started
- Copy `.env.example` to `.env`
- Run `composer install` or `php composer.phar install` to install required packages
- Run `php artisan key:generate` to create application key

## Files Affected
**app/Http/Controllers/MailsController.php**
```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailUsingMailgun;

class MailsController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function send(Request $request)
    {
        $to = $request->email;
        $content = $request->message;

        Mail::to($to)->send(new MailUsingMailgun(array('content' => $content)));

        if (Mail::failures()) {
            return redirect()
                ->back()
                ->with('error', 'Unable to send mail.');
        }

        return redirect()
            ->back()
            ->with('success', 'Mail sent.');
    }
}
```

**app/Mail/MailUsingMailgun.php**
```php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailUsingMailgun extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mailgun');
    }
}
```
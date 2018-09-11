<?php
/**
 * This file is part of the arcanite-et package.
 *
 *  (c) Artem Prosvetov <dragomeat@dragomeat.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Mail;

use App\Code;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class AuthAttempted
 */
class AuthAttempted extends Mailable
{
    use SerializesModels;
    /**
     * @var Code
     */
    private $code;

    /**
     * AuthAttempted constructor.
     * @param Code $code
     */
    public function __construct(Code $code)
    {
        $this->code = $code;
    }

    /**
     * @return AuthAttempted
     */
    public function build(): AuthAttempted
    {
        return $this->subject('Auth attempted')
            ->markdown('emails.auth.attempted', [
                'code' => $this->code
            ]);
    }
}

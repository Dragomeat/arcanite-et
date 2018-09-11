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

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AuthRequest
 */
class IssueRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  /**
 * Attempt to authenticate the request's credentials.
 *
 * @throws \Illuminate\Validation\ValidationException
 */
public function authenticate()
{
    $user = User::where('code', $this->code)->first();

    if (!$user) {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'code' => trans('auth.failed'),
        ]);
    }

    // Check if the user's status is 'admin'
    if ($user->status == 'admin') {
        // If user is admin, log them in without generating or validating any code
        Auth::login($user, $this->boolean('remember'));

        // Clear rate limiter as the login was successful
        RateLimiter::clear($this->throttleKey());

        return;
    }

    // Continue with code validation for non-admin users
    $generatedCode = session()->get('randomCode');

    if ($this->code !== $generatedCode) {
        throw ValidationException::withMessages([
            'code' => trans('auth.failed') . ' - Code: ' . $this->code . ', Generated Code: ' . $generatedCode,
        ]);
    }

    Auth::login($user, $this->boolean('remember'));

    // Clear rate limiter as the login was successful
    RateLimiter::clear($this->throttleKey());
}

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'active_code' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('active_code')) . '|' . $this->ip());
    }
}

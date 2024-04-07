<?php

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Storage;

if (! function_exists('can')) {
    function can(string $action): bool
    {
        return auth()->user()->can($action);
    }
}

if (! function_exists('cannot')) {
    function cannot(string $action): bool
    {
        return auth()->user()->cannot($action);
    }
}

if (! function_exists('hasRole')) {
    function hasRole(string $role): bool
    {
        return auth()->user()->hasRole($role);
    }
}

if (! function_exists('abort_if_cannot')) {
    function abort_if_cannot(string $action, int $code = 403): void
    {
        $message = 'You do not have permissions to '.strtolower(str_replace('_', ' ', $action));
        abort_unless(auth()->user()->can($action), $code, $message);
    }
}

if (! function_exists('add_user_log')) {
    function add_user_log($data)
    {
        AuditTrail::create([
            'user_id' => auth()->id(),
            'title' => $data['title'] ?? '',
            'link' => $data['link'] ?? '',
            'reference_id' => $data['id'] ?? 0,
            'section' => $data['section'] ?? '',
            'type' => $data['type'] ?? '',
        ]);
    }
}

if (! function_exists('get_initials')) {
    function get_initials(string $name): string
    {
        $words = explode(' ', $name);
        $initials = null;
        foreach ($words as $w) {
            $initials .= $w[0] ?? '';
        }

        return $initials;
    }
}

if (! function_exists('create_avatar')) {
    function create_avatar(string $name, string $filename, string $path): string
    {
        $avatar = new LasseRafn\InitialAvatarGenerator\InitialAvatar();
        $source = $avatar->background('#000')->color('#fff')->name($name)->generate()->stream();

        Storage::disk('public')->put($path.$filename, $source);

        return $path.$filename;
    }
}

if (! function_exists('vat')) {
    function vat(float $price, int $vat): string
    {
        $total = $price * ($vat / 100) + $price;

        return number_format($total / 100, 2);
    }
}

if (! function_exists('size_readable')) {
    function size_readable(int $bytes): string
    {
        $i = floor(log($bytes, 1024));

        return round($bytes / (1024 ** $i), [0, 0, 2, 2, 3][$i]).['B', 'kB', 'MB', 'GB', 'TB'][$i];
    }
}

if (! function_exists('in_array_r')) {
    function in_array_r($needle, $haystack, $strict = false): bool
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }
}

function toc($html)
{
    preg_match_all('/<h([1-6])*[^>]*>(.*?)<\/h[1-6]>/', $html, $matches);

    $index = '<ul>';
    $prev = 2;

    foreach ($matches[0] as $i => $match) {
        $curr = $matches[1][$i];
        $text = strip_tags($matches[2][$i]);
        $slug = strtolower(str_replace('--', '-', preg_replace('/[^\da-z]/i', '-', $text)));
        $anchor = '<a name="'.$slug.'">'.$text.'</a>';
        $html = str_replace($text, $anchor, $html);

        $prev <= $curr ?: $index .= str_repeat('</ul>', ($prev - $curr));
        $prev >= $curr ?: $index .= '<ul>';

        $index .= '<li><a href="#'.$slug.'">'.$text.'</a></li>';

        $prev = $curr;
    }

    $index .= '</ul>';

    return ['html' => $html, 'index' => $index];
}

if (! function_exists('storage_exists')) {
    function storage_exists($file, $disk = 'public'): bool
    {
        if ($file == '') {
            return false;
        }

        return Storage::disk($disk)->exists($file);
    }
}

if (! function_exists('storage_url')) {
    function storage_url($file, $disk = 'public'): string
    {
        return Storage::url($file);
    }
}

function current_package()
{
    return request()->segment(2);
}

function current_version()
{
    return request()->segment(3);
}

function current_page()
{
    return request()->segment(4);
}

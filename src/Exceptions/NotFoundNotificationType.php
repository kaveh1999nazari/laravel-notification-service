<?php

namespace Kaveh\NotificationService\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class NotFoundNotificationType extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => "نوع نوتیف شما یافت نشد",
        ], 406);
    }

}

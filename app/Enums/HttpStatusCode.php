<?php declare(strict_types=1);

namespace App\Enums;

enum HttpStatusCode: int
{
    # HTTP Codes
    case Ok = 200;
    case Created = 201;
    case NoContent = 204;
    case NotModified = 304;
    case InvalidRequest = 400;
    case AuthenticationFailure = 401;
    case NoAccessPermissions = 403;
    case NotFound = 404;
    case NotAllowedMethod = 405;
    case Conflict = 409;
    case LengthRequired = 411;
    case PreconditionFailed = 412;
    case RequestBodyTooLarge = 413;
    case InvalidRange = 416;
    case ServerError = 500;
    case ServerBusy = 503;
    case UnprocessableEntity = 422;

    # Custom Codes
    case Success = 1000;
    case UnexpectedErrorOccurred = 1500;

    public function readableName(): string
    {
        return preg_replace('/(?<!^)[A-Z]/', ' $0', $this->name);
    }

    # Get an Extension list based on a status case
    public function getExtensionList(): array
    {
        return match ($this) {
            # HTTP Codes
            self::Ok => ['code'=>'200', 'en'=>'success', 'ar'=>'تمت بنجاح'],
            self::Created => ['code'=>'201', 'en'=>'created', 'ar'=>'تم الانشاء'],
            self::NoContent => ['code'=>'204', 'en'=>'no content', 'ar'=>'لايوجد محتوى'],
            self::NotModified => ['code'=>'304', 'en'=>'not modified', 'ar'=>'لم يتم التعديل'],
            self::InvalidRequest => ['code'=>'400', 'en'=>'invalid request', 'ar'=>'طلب غيرصالح'],
            self::AuthenticationFailure => ['code'=>'401', 'en'=>'authentication failure', 'ar'=>'فشل المصادقة'],
            self::NoAccessPermissions => ['code'=>'403', 'en'=>'no permissions to access', 'ar'=>'لا تمتلك أذونات للوصول'],
            self::NotFound => ['code'=>'404', 'en'=>'not found', 'ar'=>'لم يتم العثورعلى اي نتائج'],
            self::NotAllowedMethod => ['code'=>'405', 'en'=>'not allowed method', 'ar'=>'عملية غيرمسموح بها'],
            self::Conflict => ['code'=>'409', 'en'=>'conflict', 'ar'=>'عدم تعيين'],
            self::LengthRequired => ['code'=>'411', 'en'=>'length required', 'ar'=>'تم تجاوزالطول المطلوب'],
            self::PreconditionFailed => ['code'=>'412', 'en'=>'precondition failed', 'ar'=>'فشل الشرط المسبق'],
            self::RequestBodyTooLarge => ['code'=>'413', 'en'=>'request body too large', 'ar'=>'نص الطلب كبير جدًا'],
            self::InvalidRange => ['code'=>'416', 'en'=>'invalid range', 'ar'=>'نطاق غير صالح'],
            self::ServerError => ['code'=>'500', 'en'=>'server error', 'ar'=>'خطأ في الخادم'],
            self::ServerBusy => ['code'=>'503', 'en'=>'server busy', 'ar'=>'الملقم مشغول'],
            self::UnprocessableEntity => ['code'=>'422', 'en'=>'unprocessable entity', 'ar'=>'مدخلات غيرقابل للمعالجة'],

            # Custom Codes | code group 1
            self::Success => ['code'=>'1000', 'en'=>'success', 'ar'=>'تمت بنجاح'],
            self::UnexpectedErrorOccurred => ['code'=>'1500', 'en'=>'unexpected error occurred', 'ar'=>'حدث خطأ غيرمتوقع'],
        };
    }
}

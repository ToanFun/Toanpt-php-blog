<?php

namespace App\Http\Controllers\Traits;

use App\Application\Constants\ResponseCode;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

/**
 *  @OA\Components(
 *     @OA\Response(
 *         response="success_with_no_content",
 *         description="Success",
 *         @OA\JsonContent(
 *             example={
 *                 "meta": {
 *                     "success": true,
 *                     "timestamp": 123456789,
 *                 },
 *                 "data": null,
 *                 "errors": null,
 *             },
 *         ),
 *     ),
 * ),
 */
trait ResponseTrait
{
  /**
   * The current path of collection resource to respond
   *
   * @var string
   */
  protected string $resourceCollection;

  /**
   * Response success with content
   *
   * @param  mixed   $data
   * @param  string  $message
   * @param  int     $status
   *
   * @return JsonResponse
   */
  protected function successWithContent(mixed $data = [], string $message = '', int $status = 200): JsonResponse
  {
    return response()->json([
      'meta'  => [
        'success'   => true,
        'timestamp' => $this->getTimestampInMilliseconds(),
        'message'   => $message,
      ],
      'data'  => $data,
      'errors' => null,
    ], $status);
  }

  /**
   * Return success with message
   *
   * @param  string  $message
   * @param  int     $status
   *
   * @return JsonResponse
   */
  protected function successWithMessage(string $message): JsonResponse
  {
    return response()->json([
      'meta'    => [
        'success'   => true,
        'timestamp' => $this->getTimestampInMilliseconds(),
      ],
      'data'    => null,
      'message' => trim($message),
      'errors'  => null,
    ]);
  }

  /**
   * Return no content for delete, change status requests
   *
   * @param  string  $message
   * @param  int     $status
   *
   * @return JsonResponse
   */
  protected function successWithNoContent(string $message = '', int $status = 200): JsonResponse
  {
    return response()->json([
      'meta'   => [
        'success'   => true,
        'timestamp' => $this->getTimestampInMilliseconds(),
        'message'   => $message,
      ],
      'data'   => null,
      'errors' => null,
    ], $status);
  }

  /**
   * Response fail with error
   *
   * @param  string  $errorCode
   * @param  string  $errorMessage
   * @param  int  $status
   *
   * @return JsonResponse
   */
  public function failedWithError(string $errorCode = '', string $errorMessage = '', int $status = 400): JsonResponse
  {
    return response()->json([
      'meta'  => [
        'success'   => false,
        'timestamp' => $this->getTimestampInMilliseconds(),
      ],
      'data'  => null,
      'errors' => [
        'error_code'    => $errorCode,
        'error_bags'    => null,
        'error_message' => $errorMessage ?? 'エラーがあります',
      ],
    ], $status);
  }

  /**
   * Response fail with error
   *
   * @param  Validator  $validator
   * @param  string  $errorMessage
   * @param  int  $status
   *
   * @return JsonResponse
   */
  public function failedWithValidateError(Validator $validator, string $errorMessage = '', int $status = 422): JsonResponse
  {
    $errorBags = [];
    foreach ($validator->errors()->messages() as $field => $message) {
      $errorBags[$field] = $message[0];
    }

    return response()->json([
      'meta'  => [
        'success'   => false,
        'timestamp' => $this->getTimestampInMilliseconds(),
      ],
      'data'  => null,
      'errors' => [
        'error_code'    => ResponseCode::RESPONSE_CODE_NOT_FOUND,
        'error_bags'    => $errorBags,
        'error_message' => $errorMessage ?? 'エラーがあります',
      ],
    ], $status);
  }

  /**
   * Get current response timestamp
   *
   * @return int
   */
  private function getTimestampInMilliseconds(): int
  {
    return intdiv((int) now()->format('Uu'), 1000);
  }
}

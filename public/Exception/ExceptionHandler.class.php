<?php
use Slim\Handlers\ErrorHandler;

class ExceptionHandler extends ErrorHandler {
    public function __construct($callableResolver, $responseFactory, $logger = null) {
        parent::__construct($callableResolver, $responseFactory, $logger);
        $this->setDefaultErrorRenderer('application/json', $this->errorRenderers['application/json']);
    }
//     public function __invoke($request, $response, $exception) {
//         print_r('here');
//         return $response
//             ->withStatus(500)
//             ->withHeader('Content-Type', 'application/json')
//             ->write(json_encode(['message' => $exception->getMessage()], JSON_PRETTY_PRINT));
//    }

   protected function logError(string $error): void {
        // print_r($error);
    }

}
?>
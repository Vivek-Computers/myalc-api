<?php
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
    use Slim\Psr7\Response;
    
    class AuthenticationMiddleware {
        public function __invoke(Request $request, RequestHandler $handler): Response {
            $response = $handler->handle($request);
            $existingContent = (string) $response->getBody();
        
            $response = new Response();
            $response->getBody()->write('BEFORE' . $existingContent);
        
            return $response;
        }

        private function decodeJWT($encodedToken) {
            $isAuthorized = false;
    
            try {
                $this->setDecodedToken(stdClassToArray(JWT::decode($encodedToken, new Key($this->getPublicKey(), 'RS256'))));
                $isAuthorized = true;
            } catch(Exception $e) {}
    
            return $isAuthorized;
        }
    
        private function isAuthorised() {
            if(!isset($_SERVER['HTTP_AUTHORIZATION'])) {
                return false;
            }
    
            return $this->decodeJWT(str_replace( 'Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']));
        }
    }
?>
<?php
namespace MoodMap\MainBundle\Handler;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface,
                                       AuthenticationFailureHandlerInterface {

    private $router;

    public function __construct(Router $router) {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        if ($request->isXmlHttpRequest()) {
            // If the user tried to access a protected resource and was forces to login
            // redirect him back to that resource
            if ($targetPath = $request->getSession()->get('_security.target_path')) {
                $url = $targetPath;
            } else {
                // Otherwise, redirect him to map view
                $url = $this->router->generate('map');
            }
            $result = array('success' => true, 'url' => $url);
            return new Response(json_encode($result));
        } else {
            // Handle non XmlHttp request here
        }
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
        if ($request->isXmlHttpRequest()) {
            $result = array('success' => false, 'message' => "Bad Credentials");
            return new Response(json_encode($result));
        } else {
            // Handle non XmlHttp request here
        }
    }
}

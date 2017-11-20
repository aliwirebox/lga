<?php

/*** Broker functions ***/

function getBrokerForEmail($email)
{
    $provider = getProviderForEmail($email);

    if (!$provider) {
        return null;
    }

    return getBrokerForProvider($provider);
}

function getBrokerForProvider($provider)
{
    $brokerList = config('auth.passwords');
    $context['provider'] = $provider;

    return arrayFilterKeysToSingleValue($brokerList, function ($broker) use ($provider) {
        return isBrokerForProvider($broker, $provider);
    }, $context);
}

function isBrokerForProvider($broker, $provider)
{
    return (isset($broker['provider']) && $broker['provider'] === $provider);
}

/*** Guard functions ***/

function getGuard()
{
    return session('guard');
}

function setGuard($guard)
{
    session(['guard' => $guard]);
}

function unsetGuard()
{
    app('session')->put('guard');
}

function getDefaultGuard()
{
    $defaultList = config('auth.defaults');

    return $defaultList['guard'];
}

function getGuardForUserOrDefault($user)
{
    $userProvider = getProviderForUser($user);

    if (!$userProvider) {
        return getDefaultGuard();
    }

    $userGuard = getGuardForProvider($userProvider);

    if (!$userGuard) {
        return getDefaultGuard();
    }

    return $userGuard;
}

function getGuardForProvider($provider)
{
    $guardList = config('auth.guards');
    $context['provider'] = $provider;

    return arrayFilterKeysToSingleValue($guardList, function ($guard) use ($provider) {
        return isGuardForProvider($guard, $provider);
    }, $context);
}

function guardRequiresEmailVerificationBeforeLogin($guard)
{
    $provider = getProviderForGuard($guard);

    return providerKeyRequiresEmailVerificationBeforeLogin($provider);
}

function guardRequiresEmailVerification($guard)
{
    $provider = getProviderForGuard($guard);

    return providerKeyRequiresEmailVerification($provider);
}

function isGuardForProvider($guard, $provider)
{
    return (isset($guard['provider']) && $guard['provider'] === $provider);
}

/*** Provider functions ***/

function getProviderForGuard($guard)
{
    $guardList = config('auth.guards');

    if (empty($guardList[$guard]['provider'])) {
        Log::error("No provider set for $guard guard", [$guardList]);
        abort(500);
    }

    return $guardList[$guard]['provider'];
}

function getProviderForEmail($email)
{
    $providerList = config('auth.providers');
    $context['email'] = $email;

    return arrayFilterKeysToSingleValue($providerList, function ($provider) use ($email) {
        return isProviderForEmail($provider, $email);
    }, $context);
}

function getProviderForUser($user)
{
    $providerList = config('auth.providers');
    $context['userClass'] = get_class($user);

    return arrayFilterKeysToSingleValue($providerList, function ($provider) use ($user) {
        return isProviderForUser($provider, $user);
    }, $context);
}

function hasProviderUserClass($provider)
{
    return !empty($provider['model']) && class_exists($provider['model']);
}

function isProviderForEmail($provider, $email)
{
    if (!hasProviderUserClass($provider)) {
        return false;
    }

    $user = $provider['model']::whereEmail($email)->first();

    return ($user);
}

function isProviderForUser($provider, $user)
{
    return (isset($provider['model']) && $provider['model'] === get_class($user));
}

function providerKeyRequiresEmailVerificationBeforeLogin($providerKey)
{
    $providerList = config('auth.providers');

    return isset($providerList[$providerKey]) && providerRequiresEmailVerificationBeforeLogin($providerList[$providerKey]);
}

function providerKeyRequiresEmailVerification($providerKey)
{
    $providerList = config('auth.providers');

    return isset($providerList[$providerKey]) && providerRequiresEmailVerification($providerList[$providerKey]);
}

function providerRequiresEmailVerificationBeforeLogin($provider)
{
    return hasProviderUserClass($provider) && isset($provider['verify_email_before_login']) && $provider['verify_email_before_login'];
}

function providerRequiresEmailVerification($provider)
{
    return hasProviderUserClass($provider) && isset($provider['verify_email']) && $provider['verify_email'];
}

/*** User funtions ***/

function checkAuth()
{
    $guard = getGuard();

    return Auth::guard($guard)->check();
}

function getCurrentUser()
{
    $guard = getGuard();

    return Auth::guard($guard)->user();
}

function getUserType()
{
    $user = getCurrentUser();

    if ($user) {
        return $user->getUserType();
    }

    return 'user';
}

function getUserHomeRoute()
{
    $user = getCurrentUser();

    if ($user) {
        return $user->getHomeRoute();
    }

    return route('home');
}

function loginUser($user)
{
    $guard = getGuardForUserOrDefault($user);

    setGuard($guard);

    Auth::guard($guard)->login($user);

    Log::info("Auth: Login {$user->email} into $guard guard");
}

/*** Misc funtions ***/

function arrayFilterKeysToSingleValue($list, $callback, array $context = [])
{
    $filteredKeyList = array_keys(array_filter($list, $callback));

    $context['caller'] = getCallingFunction();
    $context['fullList'] = $list;
    $context['filteredList'] = $filteredKeyList;

    $numberOfKeys = count($filteredKeyList);

    if ($numberOfKeys == 0) {
        Log::warning('Zero keys found in list', $context);
        return null;
    }

    if ($numberOfKeys > 1) {
        Log::error('More than one key found in list', $context);
    }

    return array_shift($filteredKeyList);
}

function getCallingFunction()
{
    return debug_backtrace()[2]['function'];
}

-- Final SQL Script to Reset Mobile Verification for Old Users
-- Run this in phpMyAdmin to reset mobile verification for users before August 26, 2025

-- STEP 1: Check how many users will be affected (run this first to see the impact)
SELECT 
    'BEFORE RESET' as status,
    COUNT(*) as total_old_users,
    COUNT(CASE WHEN mobile_verified_at IS NOT NULL THEN 1 END) as verified_users,
    COUNT(CASE WHEN mobile_verified_at IS NULL THEN 1 END) as unverified_users
FROM users 
WHERE created_at < '2025-08-26 00:00:00';

-- STEP 2: Show sample of users that will be affected
SELECT 
    'USERS TO BE RESET' as action,
    id, 
    name, 
    mobile, 
    created_at, 
    mobile_verified_at
FROM users 
WHERE created_at < '2025-08-26 00:00:00' 
AND mobile_verified_at IS NOT NULL
ORDER BY created_at DESC
LIMIT 20;

-- STEP 3: ACTUAL RESET QUERY (run this after checking the above)
-- This will reset mobile_verified_at to NULL for users before Aug 26, 2025
UPDATE users 
SET 
    mobile_verified_at = NULL,
    updated_at = NOW()
WHERE created_at < '2025-08-26 00:00:00' 
AND mobile_verified_at IS NOT NULL;

-- STEP 4: Verify the changes (run this after the UPDATE)
SELECT 
    'AFTER RESET' as status,
    COUNT(*) as total_old_users,
    COUNT(CASE WHEN mobile_verified_at IS NOT NULL THEN 1 END) as still_verified,
    COUNT(CASE WHEN mobile_verified_at IS NULL THEN 1 END) as now_unverified
FROM users 
WHERE created_at < '2025-08-26 00:00:00';

-- STEP 5: Show final sample of users (should all be unverified now)
SELECT 
    'FINAL STATUS' as action,
    id, 
    name, 
    mobile, 
    created_at, 
    mobile_verified_at
FROM users 
WHERE created_at < '2025-08-26 00:00:00' 
ORDER BY created_at DESC
LIMIT 10;


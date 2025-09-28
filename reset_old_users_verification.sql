-- SQL Script to Reset Mobile Verification for Old Users
-- Run this in phpMyAdmin to reset mobile verification for users before August 26, 2025

-- First, let's see how many users will be affected (run this first to check)
SELECT 
    COUNT(*) as total_old_users,
    COUNT(CASE WHEN mobile_verified_at IS NOT NULL THEN 1 END) as verified_users,
    COUNT(CASE WHEN mobile_verified_at IS NULL THEN 1 END) as unverified_users
FROM users 
WHERE created_at < '2025-08-26 00:00:00';

-- Show sample of users that will be affected
SELECT 
    id, 
    name, 
    mobile, 
    created_at, 
    mobile_verified_at,
    'WILL BE RESET' as action
FROM users 
WHERE created_at < '2025-08-26 00:00:00' 
AND mobile_verified_at IS NOT NULL
ORDER BY created_at DESC
LIMIT 20;

-- ACTUAL RESET QUERY (run this after checking the above)
-- This will reset mobile_verified_at to NULL for users before Aug 26, 2025
UPDATE users 
SET 
    mobile_verified_at = NULL,
    updated_at = NOW()
WHERE created_at < '2025-08-26 00:00:00' 
AND mobile_verified_at IS NOT NULL;

-- Verify the changes (run this after the UPDATE)
SELECT 
    COUNT(*) as total_old_users,
    COUNT(CASE WHEN mobile_verified_at IS NOT NULL THEN 1 END) as still_verified,
    COUNT(CASE WHEN mobile_verified_at IS NULL THEN 1 END) as now_unverified
FROM users 
WHERE created_at < '2025-08-26 00:00:00';

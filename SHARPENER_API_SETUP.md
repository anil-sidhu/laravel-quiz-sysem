# Sharpener Tech API Integration

This project has been updated to use Sharpener Tech's SMS API for OTP functionality.

## Environment Variables

Add the following variables to your `.env` file:

```env
# Sharpener Tech API Configuration
SHARPENER_API_KEY=abcd1234apik3324324324ey
SHARPENER_BASE_URL=https://test.sharpener.tech/api/sharpener-auth
```

## API Endpoints Used

1. **Send OTP**: `POST /send-otp`
   - Sends OTP to user's mobile number
   - Requires: `mobileNo`, `name`

2. **Verify OTP**: `POST /verify-otp`
   - Verifies the OTP entered by user
   - Requires: `mobileNo`, `otp`, `name`
   - Optional: `utmData` object

3. **Resend OTP**: `POST /send-otp` (same as Send OTP)
   - Resends OTP to user's mobile number

## Changes Made

1. **New Service**: `app/Services/SharpenerTechService.php`
   - Handles all Sharpener Tech API interactions
   - Includes proper error handling and logging

2. **Updated UserController**: `app/Http/Controllers/UserController.php`
   - Replaced Fast2SMS with Sharpener Tech service
   - Updated OTP verification to use Sharpener Tech's verify API
   - Removed local OTP generation (now handled by Sharpener Tech)

## Key Differences from Previous Implementation

- **No Local OTP Generation**: Sharpener Tech handles OTP generation
- **API-based Verification**: OTP verification is done through Sharpener Tech's API
- **Better Error Handling**: Improved error responses for failed API calls
- **Lead Generation**: Sharpener Tech can track leads for their courses

## Testing

1. Set up the environment variables
2. Test signup flow with OTP verification
3. Test login flow with OTP verification
4. Test resend OTP functionality

## Notes

- The API key provided is for testing environment
- Production environment may require different API key and base URL
- All API calls are logged for debugging purposes

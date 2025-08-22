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

## Troubleshooting

### OTP Not Received

If the API returns success but OTP is not received on mobile:

1. **Check API Response**: The API should return `{"status":"success","message":"Otp Sent Successfully"}`

2. **Test API Connection**: Visit `/test-sharpener-api` to test the API connectivity

3. **Common Issues**:
   - **Test Environment**: The test API might not actually send SMS
   - **Mobile Number Format**: Ensure mobile number is in correct format (10 digits for India)
   - **API Key**: Verify the API key is correct
   - **Network Issues**: Check if Sharpener Tech's SMS gateway is working

4. **Contact Sharpener Tech**: If API returns success but no SMS received, contact Sharpener Tech support

### Debug Steps

1. Check Laravel logs: `storage/logs/laravel.log`
2. Test API manually using curl:
   ```bash
   curl --location 'https://test.sharpener.tech/api/sharpener-auth/send-otp' \
   --header 'API-KEY: abcd1234apik3324324324ey' \
   --header 'Content-Type: application/json' \
   --data '{
     "mobileNo": "8285537543",
     "name": "Test User"
   }'
   ```

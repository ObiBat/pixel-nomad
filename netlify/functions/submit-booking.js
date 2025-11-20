// Netlify Function for Photography Booking Form Submission
// Sends booking requests directly to obibatbileg@gmail.com

exports.handler = async (event, context) => {
  // Set CORS headers
  const headers = {
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Headers': 'Content-Type',
    'Access-Control-Allow-Methods': 'POST, OPTIONS',
    'Content-Type': 'application/json'
  };

  // Handle preflight requests
  if (event.httpMethod === 'OPTIONS') {
    return {
      statusCode: 200,
      headers,
      body: ''
    };
  }

  // Only allow POST requests
  if (event.httpMethod !== 'POST') {
    return {
      statusCode: 405,
      headers,
      body: JSON.stringify({ success: false, message: 'Method not allowed' })
    };
  }

  try {
    // Parse request body
    const data = JSON.parse(event.body);

    // Validate required fields
    if (!data.customerName || !data.email || !data.mobileNumber || !data.preferredDate) {
      return {
        statusCode: 400,
        headers,
        body: JSON.stringify({ success: false, message: 'Missing required fields' })
      };
    }

    // Validate email format
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(data.email)) {
      return {
        statusCode: 400,
        headers,
        body: JSON.stringify({ success: false, message: 'Invalid email address' })
      };
    }

    // Prepare email content for Netlify Form submission
    const formData = {
      'form-name': 'photography-booking',
      'customer-name': data.customerName,
      'email': data.email,
      'mobile': data.mobileNumber,
      'preferred-date': data.preferredDate,
      'message': data.message || 'No additional message provided'
    };

    // Submit to Netlify Forms (which will forward to your email)
    const netlifyResponse = await fetch('https://obijpg.com/', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams(formData).toString()
    });

    if (netlifyResponse.ok) {
      return {
        statusCode: 200,
        headers,
        body: JSON.stringify({
          success: true,
          message: 'Booking request sent successfully'
        })
      };
    } else {
      throw new Error('Failed to submit form');
    }

  } catch (error) {
    console.error('Error:', error);
    return {
      statusCode: 500,
      headers,
      body: JSON.stringify({
        success: false,
        message: 'Failed to send booking request. Please try again.'
      })
    };
  }
};


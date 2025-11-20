# Netlify Form Setup for Photography Bookings

This website uses Netlify's built-in form handling to send photography booking requests directly to your email.

## ✅ What's Already Configured

The contact form (`contact.html`) is already set up with:
- `data-netlify="true"` attribute
- Form name: `photography-booking`
- Spam protection (honeypot)
- All required fields properly named

## 🔧 Steps to Activate Email Notifications

### 1. Deploy Your Site to Netlify
```bash
git add .
git commit -m "Add Netlify form support"
git push
```

### 2. Configure Email Notifications in Netlify Dashboard

1. Go to your Netlify dashboard: https://app.netlify.com
2. Select your site (obi-jpg)
3. Go to **Site Settings** → **Forms**
4. Click on **Form notifications**
5. Click **Add notification** → **Email notification**
6. Configure:
   - **Event to listen for:** New form submission
   - **Form:** photography-booking
   - **Email to notify:** obibatbileg@gmail.com
   - **Custom email subject (optional):** New Photography Booking Request

### 3. Test the Form

1. Go to your live site: https://obijpg.com/contact.html
2. Fill out the booking form
3. Submit
4. Check your email at obibatbileg@gmail.com

## 📧 Email Format You'll Receive

```
From: Netlify Forms <team@netlify.com>
Subject: New form submission: photography-booking

customer-name: John Doe
email: john@example.com
mobile: 0412 345 678
preferred-date: 2025-12-01
message: I'm interested in the Full Day Coverage package for my wedding.
```

## 🎯 Features

- ✅ Zero cost (Netlify free tier includes 100 form submissions/month)
- ✅ Built-in spam protection
- ✅ Automatic email notifications
- ✅ Form submissions stored in Netlify dashboard
- ✅ No backend code required
- ✅ Works instantly after deployment

## 📊 View Form Submissions

You can also view all submissions in your Netlify dashboard:
1. Go to **Forms** tab in your site dashboard
2. Click on **photography-booking**
3. See all submissions with timestamps

## 🔒 Security

- Spam protection via honeypot field
- All submissions are validated
- Email addresses are verified
- Rate limiting included by Netlify

## 💡 Pro Tips

- Check your spam folder for the first email
- Add team@netlify.com to your contacts
- You can set up multiple email recipients
- Consider upgrading Netlify plan if you get >100 bookings/month

## 🆘 Troubleshooting

**Not receiving emails?**
1. Check Netlify dashboard under Forms to see if submissions are recorded
2. Verify email notification is set up correctly
3. Check spam/junk folder
4. Make sure you deployed after adding the form attributes

**Form not appearing in Netlify?**
1. Make sure you've deployed after adding `data-netlify="true"`
2. The form must be in the HTML (not added via JavaScript)
3. Wait 1-2 minutes after deployment for Netlify to detect it

---

**Need help?** Contact Netlify support or check: https://docs.netlify.com/forms/setup/


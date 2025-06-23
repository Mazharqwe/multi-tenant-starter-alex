// Landing Page JavaScript
class LandingPage {
    constructor() {
      this.init()
    }
  
    init() {
      this.setupScrollAnimations()
      this.setupNavbarScroll()
      this.setupSmoothScrolling()
      this.setupFormValidation()
      this.setupCounterAnimations()
    }
  
    // Navbar scroll effect
    setupNavbarScroll() {
      const navbar = document.getElementById("mainNavbar")
  
      window.addEventListener("scroll", () => {
        if (window.scrollY > 100) {
          navbar.classList.add("scrolled")
        } else {
          navbar.classList.remove("scrolled")
        }
      })
    }
  
    // Smooth scrolling for anchor links
    setupSmoothScrolling() {
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault()
          const target = document.querySelector(this.getAttribute("href"))
          if (target) {
            const offsetTop = target.offsetTop - 80
            window.scrollTo({
              top: offsetTop,
              behavior: "smooth",
            })
          }
        })
      })
    }
  
    // Scroll animations
    setupScrollAnimations() {
      const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
      }
  
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("animate")
          }
        })
      }, observerOptions)
  
      // Add scroll animation class to elements
      const animateElements = document.querySelectorAll(".feature-card, .pricing-card, .testimonial-card, .contact-card")
      animateElements.forEach((el) => {
        el.classList.add("scroll-animate")
        observer.observe(el)
      })
    }
  
    // Counter animations
    setupCounterAnimations() {
      const counters = document.querySelectorAll(".stat-item h3")
      const observerOptions = {
        threshold: 0.5,
      }
  
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            this.animateCounter(entry.target)
            observer.unobserve(entry.target)
          }
        })
      }, observerOptions)
  
      counters.forEach((counter) => {
        observer.observe(counter)
      })
    }
  
    animateCounter(element) {
      const target = element.textContent
      const isPercentage = target.includes("%")
      const isNumber = target.includes("K") || target.includes("+")
  
      let finalValue
      if (target.includes("10K")) {
        finalValue = 10000
      } else if (target.includes("500")) {
        finalValue = 500
      } else if (target.includes("99.9")) {
        finalValue = 99.9
      } else {
        return
      }
  
      let current = 0
      const increment = finalValue / 100
      const timer = setInterval(() => {
        current += increment
        if (current >= finalValue) {
          current = finalValue
          clearInterval(timer)
        }
  
        if (target.includes("K")) {
          element.textContent = Math.floor(current / 1000) + "K+"
        } else if (target.includes("%")) {
          element.textContent = current.toFixed(1) + "%"
        } else {
          element.textContent = Math.floor(current) + "+"
        }
      }, 20)
    }
  
    // Form validation
    setupFormValidation() {
      const forms = document.querySelectorAll("form")
      forms.forEach((form) => {
        form.addEventListener("submit", (e) => {
          if (!form.checkValidity()) {
            e.preventDefault()
            e.stopPropagation()
          }
          form.classList.add("was-validated")
        })
      })
    }
  
    // Show notification
    showNotification(message, type = "info") {
      const notification = document.createElement("div")
      notification.className = `alert alert-${type} position-fixed`
      notification.style.cssText = "top: 20px; right: 20px; z-index: 9999; min-width: 300px;"
      notification.innerHTML = `
              <div class="d-flex align-items-center">
                  <i class="bi bi-${type === "success" ? "check-circle-fill" : "info-circle-fill"} me-2"></i>
                  <span>${message}</span>
                  <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
              </div>
          `
  
      document.body.appendChild(notification)
  
      setTimeout(() => {
        if (notification.parentNode) {
          notification.remove()
        }
      }, 5000)
    }
  }
  
  // Utility Functions
  function startFreeTrial() {
    const modal = new window.bootstrap.Modal(document.getElementById("freeTrialModal"))
    modal.show()
  }
  
  function submitFreeTrial() {
    const form = document.getElementById("freeTrialForm")
  
    if (!form.checkValidity()) {
      form.classList.add("was-validated")
      return
    }
  
    const formData = {
      companyName: document.getElementById("companyName").value,
      fullName: document.getElementById("fullName").value,
      workEmail: document.getElementById("workEmail").value,
      phoneNumber: document.getElementById("phoneNumber").value,
      teamSize: document.getElementById("teamSize").value,
    }
  
    // Simulate API call
    landingPage.showNotification("Free trial started! Check your email for setup instructions.", "success")
  
    const modal = window.bootstrap.Modal.getInstance(document.getElementById("freeTrialModal"))
    modal.hide()
  
    // Redirect to login page after a delay
    setTimeout(() => {
      window.location.href = "login.html"
    }, 2000)
  }
  
  function selectPlan(planName) {
    landingPage.showNotification(
      `${planName.charAt(0).toUpperCase() + planName.slice(1)} plan selected! Redirecting to signup...`,
      "success",
    )
  
    setTimeout(() => {
      startFreeTrial()
    }, 1000)
  }
  
  function contactSales() {
    landingPage.showNotification("Redirecting to sales contact form...", "info")
  
    setTimeout(() => {
      window.location.href = "#contact"
    }, 1000)
  }
  
  function playDemo() {
    landingPage.showNotification("Demo video would play here. Redirecting to live demo...", "info")
  
    setTimeout(() => {
      window.location.href = "login.html"
    }, 2000)
  }
  
  function openChat() {
    landingPage.showNotification("Live chat would open here. For now, please use email support.", "info")
  }
  
  // Pricing toggle (if needed for monthly/yearly)
  function togglePricing(isYearly) {
    const prices = document.querySelectorAll(".amount")
    const periods = document.querySelectorAll(".period")
  
    if (isYearly) {
      prices[0].textContent = "290"
      prices[1].textContent = "790"
      prices[2].textContent = "1990"
      periods.forEach((period) => (period.textContent = "/year"))
    } else {
      prices[0].textContent = "29"
      prices[1].textContent = "79"
      prices[2].textContent = "199"
      periods.forEach((period) => (period.textContent = "/month"))
    }
  }
  
  // Newsletter signup
  function subscribeNewsletter(email) {
    if (!email || !email.includes("@")) {
      landingPage.showNotification("Please enter a valid email address", "danger")
      return
    }
  
    landingPage.showNotification("Thank you for subscribing to our newsletter!", "success")
  }
  
  // Social sharing
  function shareOnSocial(platform) {
    const url = encodeURIComponent(window.location.href)
    const text = encodeURIComponent("Check out TenantFlow - Multi-Tenant Appointment Management System")
  
    let shareUrl
    switch (platform) {
      case "twitter":
        shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${text}`
        break
      case "linkedin":
        shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`
        break
      case "facebook":
        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`
        break
      default:
        return
    }
  
    window.open(shareUrl, "_blank", "width=600,height=400")
  }
  
  // Cookie consent (if needed)
  function acceptCookies() {
    localStorage.setItem("cookiesAccepted", "true")
    const banner = document.getElementById("cookieBanner")
    if (banner) {
      banner.style.display = "none"
    }
  }
  
  function checkCookieConsent() {
    const accepted = localStorage.getItem("cookiesAccepted")
    if (!accepted) {
      // Show cookie banner if not accepted
      const banner = document.getElementById("cookieBanner")
      if (banner) {
        banner.style.display = "block"
      }
    }
  }
  
  // Initialize landing page
  let landingPage
  document.addEventListener("DOMContentLoaded", () => {
    landingPage = new LandingPage()
    checkCookieConsent()
  })
  
  // Add CSS for scrolled navbar
  const style = document.createElement("style")
  style.textContent = `
      .navbar.scrolled {
          background: rgba(255, 255, 255, 0.98) !important;
          box-shadow: 0 2px 20px rgba(0, 0, 0, 0.15);
      }
      
      .was-validated .form-control:valid {
          border-color: #48bb78;
          background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2348bb78' d='m2.3 6.73.94-.94 1.44 1.44L7.4 4.5l.94.94L4.6 9.18z'/%3e%3c/svg%3e");
      }
      
      .was-validated .form-control:invalid {
          border-color: #f56565;
          background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23f56565'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 4.6 2.4 2.4M8.2 4.6l-2.4 2.4'/%3e%3c/svg%3e");
      }
  `
  document.head.appendChild(style)
  
  // FAQ toggle (if FAQ section is added)
  function toggleFAQ(element) {
    const content = element.nextElementSibling
    const icon = element.querySelector(".faq-icon")
  
    if (content.style.display === "block") {
      content.style.display = "none"
      icon.classList.remove("bi-chevron-up")
      icon.classList.add("bi-chevron-down")
    } else {
      content.style.display = "block"
      icon.classList.remove("bi-chevron-down")
      icon.classList.add("bi-chevron-up")
    }
  }
  
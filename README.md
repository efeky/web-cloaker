⚠️ WARNING: This project is educational and testing purposes only.
Do not deploy this project against third‑party sites or use it for deceptive, fraudulent, or illegal activities (e.g., ad fraud, phishing, search‑engine manipulation). Always obtain explicit permission from the site owner, follow applicable laws and platform terms of service, and handle any collected data in compliance with privacy regulations (GDPR, KVKK, etc.).

Web‑Cloaker is an educational proof‑of‑concept that demonstrates web cloaking and basic bot/human differentiation techniques. The project shows how a web server can detect, log, and respond differently to traffic identified as bots (e.g., search engine crawlers, automated scanners) versus traffic identified as humans. It collects lightweight fingerprints, performs heuristic checks (User‑Agent, IP/ISP/country lookups, reverse DNS, honeypot fields), stores fingerprint data, and serves distinct content (bot.html or normal.html) depending on the result.


1️⃣-
Bot or Human Detection: Differentiates between bots (search engine crawlers, automated scanners) and human visitors.

2️⃣-
Fingerprint Collection: Gathers lightweight fingerprints based on IP, User-Agent, ISP, country, and other heuristics.

# Domain Blocking System

This document explains the domain blocking system implemented for the MrWifi application.

## Overview

The domain blocking system allows administrators to manage blocked domains across different categories. It provides functionality to:

- Manage domain blocking categories
- Add, edit, and delete blocked domains
- Import/export domain lists
- Toggle category status
- View statistics and analytics

## Database Structure

### Categories Table
- `id` - Primary key
- `name` - Category name (unique)
- `slug` - URL-friendly slug (unique)
- `description` - Category description
- `icon` - Feather icon name
- `color` - Bootstrap color class
- `is_enabled` - Whether category is active
- `is_default` - Whether category is a default system category
- `sort_order` - Display order

### Blocked Domains Table
- `id` - Primary key
- `domain` - Domain name (normalized)
- `category_id` - Foreign key to categories
- `notes` - Optional notes
- `block_subdomains` - Whether to block subdomains
- `is_active` - Whether domain is active
- `source` - Source of domain (manual, import, api)
- `metadata` - JSON metadata for additional info

## Models

### Category Model
Located at `app/Models/Category.php`

**Key Features:**
- Automatic slug generation from name
- Relationships with blocked domains
- Scopes for enabled categories and ordering
- Helper methods for badge and avatar classes

**Relationships:**
- `blockedDomains()` - All blocked domains in this category
- `activeBlockedDomains()` - Only active blocked domains

### BlockedDomain Model
Located at `app/Models/BlockedDomain.php`

**Key Features:**
- Automatic domain normalization
- Domain validation
- Bulk import functionality
- Domain blocking logic

**Methods:**
- `normalizeDomain($domain)` - Normalizes domain format
- `validateDomain($domain)` - Validates domain format
- `blocks($url)` - Checks if domain blocks a given URL
- `bulkImport($domains, $categoryId, $options)` - Bulk import domains

## Controllers

### DomainBlockingController
Located at `app/Http/Controllers/DomainBlockingController.php`

**Endpoints:**
- `GET /domain-blocking` - Main domain blocking page
- `GET /blocked-domains` - List blocked domains (API)
- `POST /blocked-domains` - Create new blocked domain
- `GET /blocked-domains/{id}` - Show specific domain
- `PUT /blocked-domains/{id}` - Update domain
- `DELETE /blocked-domains/{id}` - Delete domain

**Additional API Endpoints:**
- `POST /api/domain-blocking/bulk-delete` - Bulk delete domains
- `POST /api/domain-blocking/import` - Import domains from file/text
- `GET /api/domain-blocking/export` - Export domains
- `POST /api/domain-blocking/categories/{id}/toggle` - Toggle category
- `GET /api/domain-blocking/stats` - Get statistics
- `POST /api/domain-blocking/check-domain` - Check if domain is blocked

### CategoryController
Located at `app/Http/Controllers/CategoryController.php`

**Endpoints:**
- `GET /categories` - List categories
- `POST /categories` - Create new category
- `GET /categories/{id}` - Show specific category
- `PUT /categories/{id}` - Update category
- `DELETE /categories/{id}` - Delete category

**Additional API Endpoints:**
- `POST /api/categories/{id}/toggle` - Toggle category status
- `POST /api/categories/reorder` - Reorder categories
- `GET /api/categories/{id}/stats` - Get category statistics

## Usage Examples

### Adding a Domain via API
```bash
curl -X POST /blocked-domains \
  -H "Content-Type: application/json" \
  -d '{
    "domain": "example.com",
    "category_id": 1,
    "notes": "Blocked for testing",
    "block_subdomains": true
  }'
```

### Importing Domains
```bash
curl -X POST /api/domain-blocking/import \
  -H "Content-Type: application/json" \
  -d '{
    "category_id": 1,
    "domains": "domain1.com\ndomain2.com\ndomain3.com",
    "block_subdomains": true,
    "overwrite": false
  }'
```

### Checking if Domain is Blocked
```bash
curl -X POST /api/domain-blocking/check-domain \
  -H "Content-Type: application/json" \
  -d '{"domain": "example.com"}'
```

### Exporting Domains
```bash
curl -X GET "/api/domain-blocking/export?format=csv&category_id=1&active_only=true"
```

## Seeding Data

The system includes seeders for default categories and sample domains:

```bash
# Seed categories
php artisan db:seed --class=CategorySeeder

# Seed sample domains
php artisan db:seed --class=BlockedDomainSeeder

# Seed all
php artisan db:seed
```

## Default Categories

1. **Adult Content** - Domains with adult/explicit content
2. **Gambling** - Online gambling and betting sites
3. **Malware** - Domains hosting malware or malicious content
4. **Social Media** - Social networking platforms
5. **Streaming** - Video and media streaming services
6. **Custom List** - Custom administrator-defined domains

## Frontend Integration

The domain blocking interface is located at `/domain-blocking` and provides:

- Category management with toggle switches
- Domain list with DataTables
- Add/Edit/Delete domain modals
- Import/Export functionality
- Real-time statistics

## Security Considerations

- All domain inputs are normalized and validated
- SQL injection protection through Eloquent ORM
- CSRF protection on all forms
- Input validation on all endpoints
- Proper error handling and logging

## Performance Considerations

- Database indexes on domain and category_id fields
- Bulk operations for large imports
- Pagination for domain listings
- Efficient queries with proper relationships
- Caching can be added for frequently accessed data

## Future Enhancements

- Scheduled domain list updates from external sources
- Domain reputation scoring
- Whitelist functionality
- Advanced filtering and search
- Audit logging for all changes
- API rate limiting
- Bulk operations UI improvements 